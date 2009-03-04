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
 */

require_once realpath(dirname(__FILE__) . '/string.php');

interface igs_DomDocument
{
    /**
     * The constructor should register as DOM objects 3 classes, each of which
     * must implement respectively:
     *  - igs_DomElement
     *  - igs_DomNodeList
     *  - igs_DomNamedNodeMap
     */
    public function __construct();

    public function getElementsByClassName($className);

    public function querySelector($selector);

    public function querySelectorAll($selector);

    /**
     * This method accepts a optional argument that is responsible of creating
     * an instance of igs_String which will eventually be returned. If it does
     * not return an instance of igs_String an UnexpectedValueException will be
     * thrown.
     *
     * @param  callback $callback OPTIONAL
     * @return igs_String
     * @throws UnexpectedValueException
     */
    public function toString($callback = null);

    /**
     * Returns the markup of the document as a string
     */
    public function __toString();
}

interface igs_DomElement
{
    /**
     * @param  string $className
     * @return igs_DomNodeList
     */
    public function getElementsByClassName($className);

    /**
     * @param  string $selector
     * @return igs_DomElement
     */
    public function querySelector($selector);

    /**
     * @param  string $selector
     * @return igs_DomNodeList
     */
    public function querySelectorAll($selector);

    /**
     * This method accepts a optional argument that is responsible of creating
     * an instance of igs_String which will eventually be returned. If it does
     * not return an instance of igs_String an UnexpectedValueException will be
     * thrown.
     *
     * @param  callback $callback
     * @return igs_String
     * @throws UnexpectedValueException
     */
    public function toString($callback = null);

    /**
     * Returns the markup of the element as a string
     * @internal It should call self::toString()->toString();
     */
    public function __toString();
}

/*
 * Should extend basic collection interfaces
 */
interface igs_DomNodeList
{}

/*
 * Should extend basic collection interfaces
 */
interface igs_DomNamedNodeMap
{}

class igsd_DomDocument extends DomDocument implements igs_DomDocument
{
    /**
     * @internal Registers DomElement, DomNodeList and DomNamedNodeMap as new
     * classes to be used internally
     * @param string $version
     * @param string $encoding
     */
    public function __construct($version = null, $encoding = null)
    {
        parent::__construct($version, $encoding);

        $this->registerNodeClass('DomElement', igs_DefaultDomElement());
        $this->registerNodeClass('DomNodeList', igs_DefaultDomNodeList());
        $this->registerNodeClass('DomNamedNodeMap', igs_DefaultNamedNodeMap());
    }

    /**
     * @param  string $className
     * @return igs_DomNodeList
     */
    public function getElementsByClassName($className)
    {}

    /**
     * @param  string $selector
     * @return igs_DomElement
     */
    public function querySelector($selector)
    {}

    /**
     * @param  string $selector
     * @return igs_DomNodeList
     */
    public function querySelectorAll($selector)
    {}

    /**
     * This method accepts a optional argument that is responsible of creating
     * an instance of igs_String which will eventually be returned. If it does
     * not return an instance of igs_String an UnexpectedValueException will be
     * thrown.
     *
     * @internal Uses DomElement::C14N()
     * @param  callable $callback
     * @return igs_String
     * @throws UnexpectedValueException
     */
    public function toString($callback = null)
    {
        if (! is_callable($factory, false, $callableName)) {
            $factory = 'igs_DefaultString';
        }

        $source = html_entity_decode($this->C14N());
        $string = call_user_func($factory, $source);

        if (! $string instanceof igs_String) {
            throw new UnexpectedValueException(
                "$callableName does not return an instance of igs_String"
            );
        }

        return $string;
    }

    /**
     * @internal Uses DomDocument::C14N()
     */
    public function __toString()
    {
        return $this->toString()->toString();
    }
}

/**
 * @return igs_DomDocument
 */
function igsd_DomDocument($version = null, $encoding = null)
{
    return new igsd_DomDocument($version, $encoding);
}

class igsd_DomElement extends DomElement implements igs_DomElement
{
    /**
     * @param  string $className
     * @return igs_DomNodeList
     */
    public function getElementsByClassName($className)
    {}

    /**
     * @param  string $selector
     * @return igs_DomElement
     */
    public function querySelector($selector)
    {}

    /**
     * @param  string $selector
     * @return igs_DomNodeList
     */
    public function querySelectorAll($selector)
    {}

    /**
     * This method accepts a optional argument that is responsible of creating
     * an instance of igs_String which will eventually be returned. If it does
     * not return an instance of igs_String an UnexpectedValueException will be
     * thrown.
     *
     * @internal Uses DomElement::C14N()
     * @param  callback $callback OPTIONAL
     * @return igs_String
     * @throws UnexpectedValueException
     */
    public function toString($callback = null)
    {
        if (! is_callable($factory, false, $callableName)) {
            $factory = 'igs_DefaultString';
        }

        $source = html_entity_decode($this->C14N());
        $string = call_user_func($factory, $source);

        if (! $string instanceof igs_String) {
            throw new UnexpectedValueException(
                "$callableName does not return an instance of igs_String"
            );
        }
    }

    /**
     * @internal Uses DomElement::C14N()
     */
    public function __toString()
    {
        return $this->toString()->toString();
    }
}

/**
 * @return igs_DomElement
 */
function igsd_DomElement($name, $value = null, $namespaceUri = null)
{
    return new igsd_DomElement($name, $value, $namespaceUri);
}
