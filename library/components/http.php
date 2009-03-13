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
     * @param  callable $dateFactory OPTIONAL
     * @return integer|igs_Date
     */
    public function getExpiryTime($dateFactory = null);

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

interface igs_HttpCookies extends ArrayAccess, Countable, Iterator
{

}
