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

// TODO Replace factory objects with callables, but allow objects that have
// a factory method to be passed as arguments too.

// ----------------------------------------------------------------------------
// String
// ----------------------------------------------------------------------------
class igsd_String implements ArrayAccess, Countable, Iterator
{
    /**
     * @var string
     */
    protected $string = '';

    /**
     * @var integer
     */
    protected $cursor = 0;

    /**
     * @param string $string
     */
    public function __construct($string)
    {
        $this->string = strval($string);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->string;
    }

    /**
     * @param  string  $substring
     * @param  integer $offset
     * @return boolean
     */
    public function contains($substring, $offset = null)
    {
        return strpos($this->string, $substring, $offset) !== false;
    }

    /**
     * @param  string $string
     * @return boolean
     */
    public function startsWith($string)
    {
        return strpos($this->string, $string) === 0;
    }

    /**
     * @param  string $string
     * @return boolean
     */
    public function endsWith($string)
    {
        return strpos(strrev($this->string), $string) === 0;
    }

    /**
     * @return igs_String
     */
    public function trim()
    {
        return $this->selfCopy(trim($this->string));
    }

    /**
     * @return igs_String
     */
    public function leftTrim()
    {
        return $this->selfCopy(ltrim($this->string));
    }

    /**
     * @return igs_String
     */
    public function rightTrim()
    {
        return $this->selfCopy(rtrim($this->string));
    }

    /**
     * @param string $separator
     * @return array
     */
    public function split($separator)
    {
        return explode($separator, $this->string);
    }

    /**
     * @param  integer $length
     * @param  string  $end Defaults to "\r\n"
     * @return igs_String
     */
    public function chunckSplit($length = 76, $end = "\r\n")
    {
        return $this->selfCopy(chunk_split($this->string, $length, $end));
    }

    /**
     * @param  string      $format Just like printf
     * @param  mixed|array $args If array behaves like vsprintf
     * @return igs_String
     */
    public function format($format, $args)
    {
        if (! is_array($args)) {
            $args = func_get_args();
            array_unshift($args);
        }

        return $this->selfCopy(vsprintf($format, $args));
    }

    /**
     * @return igs_String
     */
    public function upperCaseFirst()
    {
        return $this->selfCopy(ucfirst($this->string));
    }

    /**
     * @return igs_String
     */
    public function upperCaseWords()
    {
        return $this->selfCopy(ucwords($this->string));
    }

    /**
     * @param  string  $search
     * @param  string  $replace
     * @param  boolean $caseInsensitive Default to false
     * @return igs_String
     */
    public function replace($search, $replace, $caseInsensitive = false)
    {
        if ($caseInsensitive) {
            $string = str_ireplace($search, $replace, $this->string);
        } else {
            $string = str_replace($search, $replace, $this->string);
        }

        return $this->selfCopy($string);
    }

    /**
     * @param  string  $string
     * @param  integer $length
     * @return igs_String
     */
    public function pad($string, $length)
    {
        return $this->selfCopy(str_pad($this->string, $length, $string, STR_PAD_BOTH));
    }

    /**
     * @param  string  $string
     * @param  integer $length
     * @return igs_String
     */
    public function padLeft($string, $length)
    {
        return $this->selfCopy(str_pad($this->string, $length, $string, STR_PAD_LEFT));
    }

    /**
     * @param  string  $string
     * @param  integer $length
     * @return igs_String
     */
    public function padRight($string, $length)
    {
        return $this->selfCopy(str_pad($this->string, $length, $string, STR_PAD_RIGHT));
    }

    /**
     * @param  integer $multiplier
     * @return igs_String
     */
    public function repeat($multiplier)
    {
        return $this->selfCopy(str_repeat($this->string, $multiplier));
    }

    /**
     * @return igs_String
     */
    public function shuffle()
    {
        return $this->selfCopy(str_shuffle($this->string));
    }

    /**
     * @return integer
     */
    public function countWords($chars = null)
    {
        return str_word_count($this->string, 0, $chars);
    }

    /**
     * @return array
     */
    public function words()
    {
        return str_word_count($this->string, 1, $chars);
    }

    /**
     * @param  string  $string
     * @param  boolean $caseInsensitive Default to true
     * @return boolean
     */
    public function compare($string, $caseInsensitive = true)
    {
        if ($caseInsensitive) {
            return strcasecmp($this->string, $string) !== 0;
        } else {
            return $this->string !== $string;
        }
    }

    /**
     * @return integer
     */
    public function length()
    {
        return strlen($this->string);
    }

    /**
     * @return integer
     */
    public function substringPosition($substring)
    {
        return strpos($this->string, $substring);
    }

    /**
     * @return igs_String
     */
    public function reverse()
    {
        return $this->selfCopy(strrev($this->string));
    }

    /**
     * @param  string $needle
     * @return igs_String
     */
    public function substringNeedle($needle)
    {
        return $this->selfCopy(strstr($this->string, $needle));
    }

    /**
     * @param  string $needle
     * @return igs_String
     */
    public function substringNeedleLeft($needle)
    {
        throw new RuntimeException('Not implemented');
    }

    /**
     * @param  string $needle
     * @return igs_String
     */
    public function substringNeedleRight($needle)
    {
        throw new RuntimeException('Not implemented');
    }

    /**
     * @param  string $start
     * @param  string $length
     * @return igs_String
     */
    public function substring($start, $length)
    {
        return $this->selfCopy(substr($this->string, $start, $length));
    }

    /**
     * @return igs_String
     */
    public function lowerCase()
    {
        return $this->selfCopy(strtolower($this->string));
    }

    /**
     * @return igs_String
     */
    public function upperCase()
    {
        return $this->selfCopy(strtoupper($this->string));
    }

    /**
     * @param  string $separator
     * @return igs_String
     */
    public function camelCase($separator)
    {
        $parts  = preg_split($separator, $this->string);
        $string = '';

        foreach ($parts as $part) {
            $string .= ucwords(strtolower($part));
        }

        return $this->selfCopy($string);
    }

    /**
     * @param  integer $start
     * @param  integer $start
     * @param  string  $replace
     * @return igs_String
     */
    public function substringReplace($start, $length, $replace)
    {
        return $this->selfCopy(substr_replace($this->string, $replace, $start, $length));
    }

    /**
     * @param  integer $length
     * @param  string  $end
     * @param  boolean $cut
     * @return igs_String
     */
    public function wrap($length, $end, $cut = false)
    {
        return $this->selfCopy(wordwrap($this->string, $length, $end, $cut));
    }

    /**
     * @param  integer $offset
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->string[$offset]);
    }

    /**
     * @param  integer $offset
     * @return igs_String
     * @throws OutOfRangeException
     */
    public function offsetGet($offset)
    {
        if ($this->offsetExists($offset)) {
            return $this->selfCopy($this->string[$offset]);
        }

        throw new OutOfRangeException("Offset $offset does not exist");
    }

    /**
     * @throws BadMethodCallException This method is not implemented
     */
    public function offsetSet($offset, $value)
    {
        throw new BadMethodCallException('igs_String objects are immutable');
    }

    /**
     * @throws BadMethodCallException This method is not implemented
     */
    public function offsetUnset($offset)
    {
        throw new BadMethodCallException('igs_String objects are immutable');
    }

    /**
     * @return integer
     */
    public function count()
    {
        return strlen($this->_string);
    }

    /**
     * @return igs_String
     */
    public function current()
    {
        return $this->selfCopy($this->string[$this->cursor]);
    }

    /**
     * @return integer
     */
    public function key()
    {
        return $this->cursor;
    }

    /**
     * @return void
     */
    public function next()
    {
        $this->cursor++;
    }

    /**
     * @return void
     */
    public function rewind()
    {
        $this->cursor = 0;
    }

    /**
     * @return boolean
     */
    public function valid()
    {
        return $this->cursor < strlen($this->string);
    }

    /**
     * @param  string $string
     * @return igs_String
     */
    protected function selfCopy($string)
    {
        $class = get_class($this);
        return new $class($string);
    }
}

/**
 * @param  string
 * @return igs_String
 */
function igsd_String($string)
{
    return new igsd_String($string);
}


// ----------------------------------------------------------------------------
// Collections
// REFACTOR Vector
// TODO Implementation
// ----------------------------------------------------------------------------
interface igs_VectorFactory
{
    /**
     * @param array $vectorWannabe
     */
    public function createVector(array $vectorWannabe);
}

interface igs_Vector extends ArrayAccess, Countable, Iterator
{}

interface igs_Set
{}

interface igs_Dictionary
{}

interface igs_List
{}

interface igs_Tuple
{}

class igsd_Vector implements igs_Vector
{
    public function count()
    {}

    public function offsetExists($offset)
    {}

    public function offsetGet($offset)
    {}

    public function offsetSet($offset, $value)
    {}

    public function offsetUnset($offset)
    {}

    public function current()
    {}

    public function key()
    {}

    public function next()
    {}

    public function rewind()
    {}

    public function valid()
    {}
}


// ----------------------------------------------------------------------------
// HTTP utilities
// ----------------------------------------------------------------------------
interface igs_HttpRequest
{
    const HTTP_1_0 = 1.0;

    const HTTP_1_1 = 1.1;

    /**
     * @return string
     */
    public function getMethod();

    /**
     * @return string|igs_Uri OPTIONAL
     */
    public function getUri(igs_UriFactory $uriFactory = null);

    /**
     * @return HTTP_1_0|HTTP_1_1
     */
    public function getProtocolVersion();

    /**
     * @param  string $name
     * @param  mixed  $default OPTIONAL
     * @return mixed
     */
    public function getHeader($name, $default = null);

    /**
     * @param  igs_VectorFactory $vectorFactory OPTIONAL
     * @return array|igs_Vector
     */
    public function getHeaders(igs_VectorFactory $vectorFactory = null);

    /**
     * @param  string
     * @return boolean
     */
    public function hasHeader($name);

    /**
     * @param  string $name
     * @param  mixed  $default OPTIONAL
     * @return mixed
     */
    public function getCookie($name, $default = null);

    /**
     * @param  igs_VectorFactory $vectorFactory OPTIONAL
     * @return array|igs_Vector
     */
    public function getCookies(igs_VectorFactory $vectorFactory = null);

    /**
     * @return boolean
     */
    public function hasCookie($name);

    /**
     * @param  string $name
     * @param  mixed  $default OPTIONAL
     * @return mixed
     */
    public function getQuery($name, $default = null);

    /**
     * @param  igs_VectorFactory $vectorFactory OPTIONAL
     * @return array|igs_Vector
     */
    public function getQueries(igs_VectorFactory $vectorFactory = null);

    /**
     * @paran  string $name
     * @return boolean
     */
    public function hasQuery($name);

    /**
     * @param  string $name
     * @param  mixed  $default OPTIONAL
     * @return mixed
     */
    public function getPostDatum($name, $default = null);

    /**
     * @param  igs_VectorFactory $vectorFactory OPTIONAL
     * @return array|igs_Vector
     */
    public function getPostData(igs_VectorFactory $vectorFactory = null);

    /**
     * @param  string $name
     * @return boolean
     */
    public function hasPostDatum($name);

    /**
     * @param  string $name
     * @param  mixed  $default OPTIONAL
     * @return mixed
     */
    public function getFile($name, $default = null);

    /**
     * @param  igs_VectorFactory $vectorFactory OPTIONAL
     * @return array|igs_Vector
     */
    public function getFiles(igs_VectorFactory $vectorFactory = null);

    /**
     * @param  string $name
     * @return boolean
     */
    public function hasFile($name);

    /**
     * @param  string $name
     * @param  mixed  $default OPTIONAL
     * @return mixed
     */
    public function getArgument($name, $default = null);

    /**
     * @param  igs_VectorFactory $vectorFactory OPTIONAL
     * @return array|igs_Vector
     */
    public function getArguments(igs_VectorFactory $vectorFactory = null);

    /**
     * @return boolean
     */
    public function hasArgument($name);
}

// TODO Implementation
class igsd_HttpRequest implements igs_HttpRequest
{}

/**
 * @return igs_DefaultHttpRequest
 */
function igsd_HttpRequest()
{
    return new igsd_HttpRequest;
}

interface igs_HttpResponse
{
    /**
     * @param string           $body
     * @param array|igs_Vector $headers
     * @param array|igs_Vector $cookies
     * @param integer          $status
     */
    public function __construct($body = null, $headers = null, $cookies = null, $status = 200);

    /**
     * @param  string $name
     * @param  mixed  $default OPTIONAL
     * @return mixed
     */
    public function getHeader($name, $default = null);

    /**
     * @param  igs_VectorFactory $vectorFactory OPTIONAL
     * @return array|igs_Vector
     */
    public function getHeaders(igs_VectorFactory $vectorFactory = null);

    /**
     * @param  string
     * @return boolean
     */
    public function hasHeader($name);

    /**
     * @param  string $name
     * @param  mixed  $default OPTIONAL
     * @return mixed
     */
    public function getCookie($name, $default = null);

    /**
     * @param  igs_VectorFactory $vectorFactory OPTIONAL
     * @return array|igs_Vector
     */
    public function getCookies(igs_VectorFactory $vectorFactory = null);

    /**
     * @return boolean
     */
    public function hasCookie($name);

    /**
     * @return string
     */
    public function getBody();

    /**
     * @return boolean
     */
    public function hasBody();
}

// TODO Implementation
class igsd_HttpResponse implements igs_HttpResponse
{}

/**
 * @return igs_DefaultHttpResponse
 */
function igsd_HttpResponse()
{
    return new igsd_HttpResponse;
}

interface igs_HttpResponseBuilder
{
    /**
     * @param  string $name
     * @param  string $value
     * @return igs_HttpResponseBuilder
     */
    public function addHeader($name, $value);

    /**
     * @param  array|igs_Vector $headers
     * @return igs_HttpResponseBuilder
     */
    public function addHeaders($headers);

    /**
     * @param  string $name
     * @param  string $value
     * @return igs_HttpResponseBuilder
     */
    public function addCookie($name, $value);

    /**
     * @param  array|igs_Vector $headers
     * @return igs_HttpResponseBuilder
     */
    public function addCookies($headers);

    /**
     * @param string $body
     * @return igs_HttpResponseBuilder
     */
    public function prependBody($body);

    /**
     * @param string $body
     * @return igs_HttpResponseBuilder
     */
    public function appendBody($body);

    /**
     * @param  igs_HttpResponseFactory $responseFactory OPTIONAL
     * @return igs_HttpResponse
     */
    public function getResponse(igs_HttpResponseFactory $responseFactory = null);
}

// TODO Rethink
interface igs_HttpClient
{
    /**
     * @param igs_HttpRequest $request
     */
    public function sendRequest(igs_HttpRequest $request);

    public function setRequestAdapter(igs_HttpRequestAdapter $adapter);

    public function setCacheAdapter(igs_CacheAdapter $adapter);
}

// TODO Might need a split up because of different implementations between
// protocols. Also, a Mozilla specific DOM storage implementation would add
// yet more troubles
interface igs_HttpCookie
{
    /**
     * For cookies implementing Cookie-1 protocol (header: Set-Cookie)
     */
    const COOKIE_1 = 1;

    /**
     * For cookies implementing Cookie-2 protocol (header: Set-Cookie2)
     */
    const COOKIE_2 = 2;

    /**
     * If $name is array or igs_Vector the other arguments are ignored, but
     * $name should contain values for them stored under keys named after the
     * arguments, i.e name, value, expire, path, domain, secure, httpOnly.
     *
     * @param string|array|igs_Vector $name
     * @param string                  $value    OPTIONAL
     * @param string|integer|igs_Date $expire   OPTIONAL
     * @param string                  $path     OPTIONAL
     * @param string                  $domain   OPTIONAL
     * @param boolean                 $secure   OPTIONAL
     * @param boolean                 $httpOnly OPTIONAL
     * @param integer                 $protocol OPTIONAL
     */
    public function __construct(
        $name,
        $value    = null,
        $expire   = null,
        $path     = null,
        $domain   = null,
        $secure   = null,
        $httpOnly = true,
        $protocol = self::COOKIE_1
    );

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getValue();

    /**
     * @param  igs_DateFactory $dateFactory OPTIONAL
     * @return integer|igs_Date
     */
    public function getExpiryTime(igs_DateFactory $dateFactory = null);

    /**
     * @return boolean
     */
    public function isSessionCookie();

    /**
     * @return boolean
     */
    public function hasExpired();

    /**
     * @return string
     */
    public function getPath();

    /**
     * @return string
     */
    public function getDomain();

    /**
     * @return boolean
     */
    public function isSecure();

    /**
     * @return boolean
     */
    public function isHttpOnly();

    /**
     * @return boolean
     */
    public function isFirstProtocolCookie();

    /**
     * @return boolean
     */
    public function isSecondProtocolCookie();
}


// ----------------------------------------------------------------------------
// Date and Time utilities
// TODO Implementation
// ----------------------------------------------------------------------------
interface igs_Date
{
    /**
     * @param integer $unixTimestamp
     */
    public function __construct($unixTimestamp);

    public function getYear();

    public function isLeapYear();

    public function getMonth();

    public function getDayOfMonth();

    public function getDayOfWeek();

    public function getHour();

    public function getMinute();

    public function getSeconds();
}

interface igs_DateFactory
{
    /**
     * @return igs_Date
     */
    public function createDate();
}

// FIXME rename igs_Vector to igs_Collection
interface igs_DateInterval extends igs_Collection
{
    /**
     * @return array|igs_Collection Collection of collections of igs_DateInterval
     */
    public function toWeeks();
}


// ----------------------------------------------------------------------------
// Cache utilities
// TODO Implementation
// ----------------------------------------------------------------------------
interface igs_CacheService
{}

interface igs_CacheAdapter
{}

// ----------------------------------------------------------------------------
// Database adapters
// TODO Implementation
// ----------------------------------------------------------------------------
interface igs_DatabaseConnection
{}

interface igs_Database
{}

interface igs_DatabaseTable
{}

interface igs_DatabaseAdapter
{}

interface igs_DatabaseResultSet extends igs_Collection
{}


// ----------------------------------------------------------------------------
// Web utilities
// TODO Implementation
// ----------------------------------------------------------------------------
interface igs_WebComponent
{
    public function get();

    public function post();
}

interface igs_WebSlice extends igs_WebComponent
{}

interface igs_WebPage extends igs_WebComponent
{}

interface igs_WebApplication
{
    public function serveRequest(igs_HttpRequest $request);
}


// ----------------------------------------------------------------------------
// DOM utilities
// TODO Implementation
// ----------------------------------------------------------------------------
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
     * Returns the markup of the element as a string
     *
     * @return igs_String
     */
    public function toString(igs_StringFactory $factory);

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
     * @internal Uses DomElement::C14N()
     * @param  igs_StringFactory $factory OPTIONAL
     * @return igs_String
     */
    public function toString(igs_StringFactory $factory = null)
    {
        if ($factory === null) {
            $factory = igs_DefaultStringFactory();
        }

        $source = html_entity_decode($this->C14N());
        return $factory->createString($source);
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
     * @internal Uses DomElement::C14N()
     * @param  igs_StringFactory $factory OPTIONAL
     * @return igs_String
     */
    public function toString(igs_StringFactory $factory = null)
    {
        if ($factory === null) {
            $factory = igs_DefaultStringFactory();
        }

        $source = html_entity_decode($this->C14N());
        return $factory->createString($source);
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

// ----------------------------------------------------------------------------
// FTP utilities
// TODO Implementation
// ----------------------------------------------------------------------------
interface igs_FtpClient
{}
