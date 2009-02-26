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

class igs_String implements ArrayAccess, Countable, Iterator
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
function igs_String($string)
{
    return new igs_String($string);
}
