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
 * @category  CSV
 * @package   CSV
 */

/**
 * @package CSV
 */
interface igs_CsvReader extends ArrayAccess, Iterator
{
    /**
     * Options may include any or all of the following keys:
     *      - delimiter, defaults to ,(comma)
     *      - enclosure, defaults to "(double quote)
     *      - escape,    defaults to \(backslash)
     *
     * @param iterateable $csvFile
     * @param hashmap     $options OPTIONAL
     */
    public function __construct($csvFile, $options = array());
}

/**
 * @package CSV
 */
interface igs_CsvWriter
{
    /**
     * Options may include any or all of the following keys:
     *      - delimiter, defaults to ,(comma)
     *      - enclosure, defaults to "(double quote)
     *      - escape,    defaults to \(backslash)
     *
     * @param iterateable $stream
     * @param hashmap     $options OPTIONAL
     */
    public function __construct($data, $options = array());
}

/**
 * @package CSV
 */
class igsd_CsvReader implements igs_CsvReader
{
    /**
     * @var string Character that separates cell values
     */
    public $_delimiter = ',';

    /**
     * @var string Character that encloses the value of each "cell"
     */
    public $_enclosure = '"';

    /**
     * @var string Caracter to escape special characters
     */
    public $_escape    = '\\';

    /**
     * Options may include any or all of the following keys:
     *      - delimiter, defaults to ,(comma)
     *      - enclosure, defaults to "(double quote)
     *      - escape,    defaults to \(backslash)
     *
     * @param iterateable $stream
     * @param hashmap     $options OPTIONAL
     */
    public function __construct($stream, $options = array())
    {
        $this->_stream($stream);
        $this->_options($options);
    }

    /**
     * @param  array|Traversable|igs_Stream $stream
     * @return igs_DefaultCsvReader
     */
    public function _stream($data)
    {
        if (! (is_array($options) || $options instanceof Traversable)) {
            throw new InvalidArgumentException(
                '$data must be an array or an object implementing Traversable)'
            );
        }

        $this->stream = $data;
        return $this;
    }

    public function _options($options)
    {
        if (! (is_array($options) || $options instanceof ArrayAccess)) {
            throw new InvalidArgumentException(
                '$data must be an array or an object implementing ArrayAccess'
            );
        }

        foreach ($options as $option => $value) {
            $this->option($option, $value);
        }
    }

    /**
     * @param string $value
     * @param string $name  OPTIONAL
     */
    public function _option($value, $name = null)
    {
        $options = array('delimiter', 'enclosure', 'escape');

        if (in_array($name, $options)) {
            $this->$name = $value;
        }

        return $this;
    }
}

/**
 * Options may include any or all of the following keys:
 *      - delimiter, defaults to ,(comma)
 *      - enclosure, defaults to "(double quote)
 *      - escape,    defaults to \(backslash)
 *
 * @param  array|Traversable|igs_Stream $stream
 * @param  array|ArrayAccess $options
 * @return igs_DefaultCsvReader
 */
function igsd_CsvReader($data, $options = array())
{
    return new igsd_CsvReader($data, $options);
}

define('igsd_CsvReader', 'igsd_CsvReader');
