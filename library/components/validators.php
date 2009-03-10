<?php
/**
 * Copyright (c) 2009, Ionut Gabriel Stan. All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 *
 *    * Redistributions of source code must retain the above copyright notice,
 *      this list of conditions and the following disclaimer.
 *
 *    * Redistributions in binary form must reproduce the above copyright notice,
 *      this list of conditions and the following disclaimer in the documentation
 *      and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
 * ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
 * ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @author    Ionut G. Stan <ionut.g.stan@gmail.com>
 * @license   New BSD license
 * @copyright Copyright (c) 2009, Ionut Gabriel Stan. All rights reserved.
 * @category  Validators
 */

interface igs_Validator
{
    public function validates();
}

/**
 * Implements Specification pattern
 *
 * @method or();
 * @method and();
 * @method not();
 */
abstract class igsd_Validator implements igs_Validator
{
    abstract public function validates($object);

    /**
     * TODO Explain why __call
     */
    public function __call($operator, $rightOperands)
    {
        $operators = array('or', 'and', 'not');

        if (! in_array($operator, $operators)) {
            throw new LogicException('Operator not supported');
        }

        $validator = 'igsd_' . ucfirst(strtolower($operator)) . 'Specification';
        return new $validator($this, $rightOperand[0]);
    }
}

abstract class igsd_CompositeValidator extends igsd_Validator
{
    protected $leftOperand;

    protected $rightOperand;

    public function __construct(igs_Validator $leftOperand, igs_Validator $rightOperand)
    {
        $this->leftOperand  = $leftOperand;
        $this->rightOperand = $rightOperand;
    }
}

class igsd_AndValidator extends igsd_CompositeValidator
{
    public function validates($object)
    {
        $leftOperand  = $this->leftOperand->validates($object);
        $rightOperand = $this->rightOperand->validates($object);

        return ($leftOperand && $rightOperand);
    }
}

class igsd_OrValidator extends igsd_CompositeValidator
{
    public function validates($object)
    {
        $leftOperand  = $this->leftOperand->validates($object);
        $rightOperand = $this->rightOperand->validates($object);

        return ($leftOperand || $rightOperand);
    }
}

class igsd_NotSpecification extends igsd_CompositeValidator
{
    public function validates($object)
    {
        $leftOperand  = $this->leftOperand->validates($object);
        $rightOperand = $this->rightOperand->validates($object);

        return (! ($leftOperand && $rightOperand));
    }
}

// ----------------------------------------------------------------------------
// Examples
//
// TODO Move them somewhere else
// ----------------------------------------------------------------------------
if (__FILE__ === realpath($_SERVER['SCRIPT_FILENAME'])) {
    class PricesCollection
    {
        protected $_data;

        public function __construct()
        {
            $this->_prices = array(
                100,
                200,
                300,
                400,
                500,
                600,
                700,
                800,
                900,
                1000
            );
        }

        public function getPricesBySpecification(Specification $specification)
        {
            $prices = array();

            foreach ($this->_prices as $price) {
                if ($specification->isSatisfiedBy($price)) {
                    $prices[] = $price;
                }
            }

            return $prices;
        }
    }

    class MinimumPriceSpecification extends Specification
    {
        protected $_minPrice;

        public function __construct($minPrice)
        {
            $this->_minPrice = $minPrice;
        }

        public function isSatisfiedBy($price)
        {
            return ($price > $this->_minPrice);
        }
    }
    function MinimumPriceSpecification($minPrice) {
        return new MinimumPriceSpecification($minPrice);
    }

    class MaximumPriceSpecification extends Specification
    {
        protected $_maxPrice;

        public function __construct($maxPrice)
        {
            $this->_maxPrice = $maxPrice;
        }

        public function isSatisfiedBy($price)
        {
            return ($price < $this->_maxPrice);
        }
    }
    function MaximumPriceSpecification($maxPrice) {
        return new MaximumPriceSpecification($maxPrice);
    }



    $data = new PricesCollection;

    $users = $data->getPricesBySpecification(
                MaximumPriceSpecification(800)
                ->and(
                    MinimumPriceSpecification(300)
                    ->or(
                        MinimumPriceSpecification(200)
                    )
                )
                ->and(
                    MaximumPriceSpecification(700)
                )
            );

    print_r($users);
}
