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
 * @category  HTTP
 * @package   HTTP
 */

namespace igs
{

/**
 * @package HTTP
 */
class HttpRequest
{
    const HTTP_1_0 = 1.0;

    const HTTP_1_1 = 1.1;

    function __construct($method, $protocol, $headers, $cookies, $queries, $postData, $files)
    {}

    var $_method;

    /**
     * @return string
     */
    function getMethod()
    {}

    /**
     * @return boolean
     */
    function isGet()
    {}

    /**
     * @return boolean
     */
    function isPost()
    {}

    var $_uri;

    /**
     * @return Uri
     */
    function getUri()
    {}

    /**
     * @return HTTP_1_0|HTTP_1_1
     */
    function getProtocolVersion()
    {}

    var $_headers;

    /**
     * @param  string $name
     * @param  mixed  $default OPTIONAL
     * @return mixed
     */
    function getHeader($name, $default = null)
    {}

    /**
     * @return iterateable
     */
    function getHeaders()
    {}

    /**
     * @param  string
     * @return boolean
     */
    function hasHeader($name)
    {}

    var $_cookies;

    /**
     * @param  string $name
     * @param  mixed  $default OPTIONAL
     * @return mixed
     */
    function getCookie($name, $default = null)
    {}

    /**
     * @return iterateable
     */
    function getCookies()
    {}

    /**
     * @return boolean
     */
    function hasCookie($name)
    {}

    var $_queries;

    /**
     * @param  string $name
     * @param  mixed  $default OPTIONAL
     * @return mixed
     */
    function getQuery($name, $default = null)
    {}

    /**
     * @return iterateable
     */
    function getQueries()
    {}

    /**
     * @paran  string $name
     * @return boolean
     */
    function hasQuery($name)
    {}

    var $_postData;

    /**
     * @param  string $name
     * @param  mixed  $default OPTIONAL
     * @return mixed
     */
    function getPostDatum($name, $default = null)
    {}

    /**
     * @return iterateable
     */
    function getPostData()
    {}

    /**
     * @param  string $name
     * @return boolean
     */
    function hasPostDatum($name)
    {}

    var $_files;

    /**
     * @param  string $name
     * @param  mixed  $default OPTIONAL
     * @return mixed
     */
    function getFile($name, $default = null)
    {}

    /**
     * @return iterateable
     */
    function getFiles()
    {}

    /**
     * @param  string $name
     * @return boolean
     */
    function hasFile($name)
    {}
}

/**
 * @package HTTP
 * @return  Request
 */
function HttpRequest()
{
    return new HttpRequest;
}

/**
 * @package HTTP
 */
class HttpResponse
{
    /**
     * @param string           $body
     * @param array|igs_Vector $headers
     * @param array|igs_Vector $cookies
     * @param integer          $status
     */
    function __construct($body = null, $headers = null, $cookies = null, $status = 200)
    {}

    /**
     * @param  string $name
     * @param  mixed  $default OPTIONAL
     * @return mixed
     */
    function getHeader($name, $default = null)
    {}

    /**
     * @return iterateable
     */
    function getHeaders()
    {}

    /**
     * @param  string
     * @return boolean
     */
    function hasHeader($name)
    {}

    /**
     * @param  string $name
     * @param  mixed  $default OPTIONAL
     * @return mixed
     */
    function getCookie($name, $default = null)
    {}

    /**
     * @return iterateable
     */
    function getCookies()
    {}

    /**
     * @return boolean
     */
    function hasCookie($name)
    {}

    /**
     * @return string
     */
    function getBody()
    {}

    /**
     * @return boolean
     */
    function hasBody()
    {}
}

/**
 * @package HTTP
 * @return  Response
 */
function HttpResponse()
{
    return new HttpResponse;
}

/**
 * @package HTTP
 */
class HttpResponseBuilder
{
    /**
     * @param  string $name
     * @param  string $value
     * @return ResponseBuilder
     */
    function addHeader($name, $value)
    {}

    /**
     * @param  hashtable $headers
     * @return ResponseBuilder
     */
    function addHeaders($headers)
    {}

    /**
     * @param  string $name
     * @param  string $value
     * @return ResponseBuilder
     */
    function addCookie($name, $value)
    {}

    /**
     * @param  hashtable $headers
     * @return ResponseBuilder
     */
    function addCookies($headers)
    {}

    /**
     * @param  string $body
     * @return ResponseBuilder
     */
    function prependBody($body)
    {}

    /**
     * @param  string $body
     * @return ResponseBuilder
     */
    function appendBody($body)
    {}

    /**
     * @return Response
     */
    function getResponse()
    {}
}

/**
 * TODO Rethink
 *
 * @package HTTP
 */
class HttpClient
{
    /**
     * @param HttpRequest $request
     */
    function sendRequest($request)
    {}

    /**
     * @param mixed $adapter
     */
    function setRequestAdapter($adapter)
    {}

    /**
     * @param mixed $adapter
     */
    function setCacheAdapter($adapter)
    {}
}

/**
 * TODO Might need a split up because of different implementations between
 * protocols. Also, a Mozilla specific DOM storage implementation would add
 * yet more troubles
 *
 * @package HTTP
 */
class HttpCookie
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
    function __construct(
        $name,
        $value    = null,
        $expire   = null,
        $path     = null,
        $domain   = null,
        $secure   = null,
        $httpOnly = true,
        $protocol = self::COOKIE_1
    ){}

    /**
     * @return string
     */
    function name()
    {}

    /**
     * @return string
     */
    function value()
    {}

    /**
     * @param  callable $dateFactory OPTIONAL
     * @return mixed
     */
    function expiryTime($dateFactory = null)
    {}

    /**
     * @return boolean
     */
    function isSessionCookie()
    {}

    /**
     * @return boolean
     */
    function hasExpired()
    {}

    /**
     * @return string
     */
    function path()
    {}

    /**
     * @return string
     */
    function domain()
    {}

    /**
     * @return boolean
     */
    function isSecure()
    {}

    /**
     * @return boolean
     */
    function isHttpOnly()
    {}

    /**
     * @return boolean
     */
    function isFirstProtocolCookie()
    {}

    /**
     * @return boolean
     */
    function isSecondProtocolCookie()
    {}
}

/**
 * @package HTTP
 */
class Url
{
    /**
     * @param mixed $url
     */
    public function __construct($url)
    {}

    /**
     * @return string
     */
    public function protocol()
    {}

    /**
     * @return null|integer
     */
    public function port()
    {}

    /**
     * @return string
     */
    public function hostname()
    {}

    /**
     * @return null|string
     */
    public function path()
    {}

    /**
     * @return null|string|array
     */
    public function queryString($asArray = true)
    {}

    /**
     * @return string
     */
    public function queryStringDelimiter()
    {}

    /**
     * @return null|string
     */
    public function fragment()
    {}

    /**
     * @return null|string
     */
    public function username()
    {}

    /**
     * @return null|string
     */
    public function password()
    {}
}

/**
 * @package HTTP
 * @param   mixed $url
 * @return  Url
 */
function Url($url)
{
    return new Url($url);
}

const Url = 'igs\Url';

/**
 * @package HTTP
 */
class HttpProxy
{
    /**
     * The filter may implement any of the following methods:
     *
     * <ul>
     *      <li>requestHeaders($httpProxy)</li>
     *      <li>requestBody($httpProxy)</li>
     *      <li>responseHeaders($httpProxy)</li>
     *      <li>responseBody($httpProxy)</li>
     * </ul>
     *
     * @param object $filter
     */
    function registerFilter($filter)
    {}

    /**
     * @param integer|object Index or filter instance
     */
    function removeFilter($filter)
    {}

    /**
     * @return array All registered filters with this HTTP proxy
     */
    function filters()
    {}

    /**
     * @return igs_HttpResponse
     */
    function proxyRequest($request = null)
    {}
}

}
