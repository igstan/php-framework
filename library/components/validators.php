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

// TODO Should I let this here for IDE support?
interface igs_Validator
{
    /**
     * @param  mixed $object
     * @return boolean
     */
    public function validates($object);
}

/**
 * Implements Specification pattern
 *
 * @method igsd_CompositeValidator  or()  or(igs_Validator $rightOperand)
 * @method igsd_CompositeValidator and() and(igs_Validator $rightOperand)
 * @method igsd_CompositeValidator not() not(igs_Validator $rightOperand)
 */
abstract class igsd_Validator
{
    /**
     * @param  mixed $object
     * @return boolean
     */
    abstract public function validates($object);

    /**
     * We couldn't write 3 separate methods because PHP does not allow
     * reserved words as name of methods in declarations. On the other hand it
     * allows reserved words when calling methods. So using __call() is a
     * workaround for this limitation that allows us to have a nicer API for
     * objects implementing the Specification pattern.
     *
     * Why __call() instead of __get()/__set(). Because call allows grouping
     * of operators in one argument. We couldn't have achieved this with
     * getters/setters.
     *
     * @param  string $operator      One of 'or', 'and', 'not'
     * @param  array  $rightOperands Contains the other validator to which this
     *      one should be composed with in the moment of validation.
     * @return igsd_CompositeValidator
     * @throws BadMethodCallException when operator is not supported
     * @throws InvalidArgumentException when right operand does not have a
     *      validates() method.
     */
    public function __call($operator, $rightOperand)
    {
        $operators = array('or', 'and', 'not');

        if (! in_array($operator, $operators)) {
            throw new BadMethodCallException('Operator not supported');
        }

        if (! is_callable($rightOperand[0], 'validates')) {
            throw new InvalidArgumentException(
                'Right operand object must have a "validates()" method'
            );
        }

        $validator = 'igsd_' . ucfirst(strtolower($operator)) . 'Specification';
        return new $validator($this, $rightOperand[0]);
    }
}

/**
 * Implements Specification pattern
 */
abstract class igsd_CompositeValidator extends igsd_Validator
{
    /**
     * @var igs_Validator
     */
    protected $leftOperand;

    /**
     * @var igs_Validator
     */
    protected $rightOperand;

    /**
     * @param igs_Validator $leftOperand
     * @param igs_Validator $rightOperand
     */
    public function __construct($leftOperand, $rightOperand)
    {
        if (! is_callable(array($leftOperand, 'validates'))) {
            throw new InvalidArgumentException(
                'Left operand object must have a "validates()" method'
            );
        }

        if (! is_callable(array($rightOperand, 'validates'))) {
            throw new InvalidArgumentException(
                'Right operand object must have a "validates()" method'
            );
        }

        $this->leftOperand  = $leftOperand;
        $this->rightOperand = $rightOperand;
    }
}

/**
 * Implements Specification pattern
 */
class igsd_AndValidator extends igsd_CompositeValidator
{
    /**
     * @param  mixed $object
     * @return boolean
     */
    public function validates($object)
    {
        $leftOperand  = $this->leftOperand->validates($object);
        $rightOperand = $this->rightOperand->validates($object);

        return ($leftOperand && $rightOperand);
    }
}

/**
 * Implements Specification pattern
 */
class igsd_OrValidator extends igsd_CompositeValidator
{
    /**
     * @param  mixed $object
     * @return boolean
     */
    public function validates($object)
    {
        $leftOperand  = $this->leftOperand->validates($object);
        $rightOperand = $this->rightOperand->validates($object);

        return ($leftOperand || $rightOperand);
    }
}

/**
 * Implements Specification pattern
 */
class igsd_NotSpecification extends igsd_CompositeValidator
{
    /**
     * @param  mixed $object
     * @return boolean
     */
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
