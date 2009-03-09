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

/**
 * @see https://developer.mozilla.org/en/DOM/stylesheet
 * @see http://www.w3.org/TR/DOM-Level-2-Style/css.html#CSS-CSSStyleSheet
 *
 * @property $cssRules
 * @property $disabled
 * @property $href
 * @property $media
 * @property $ownerNode
 * @property $ownerRule
 * @property $parentStyleSheet
 * @property $title
 * @property $type
 */
class igs_CSSStyleSheet
{
    public function deleteRule()
    {}

    public function insertRule()
    {}
}

/**
 * @see https://developer.mozilla.org/en/DOM/cssRule
 * @see http://www.w3.org/TR/DOM-Level-2-Style/css.html#CSS-CSSRule
 *
 * @property $cssText
 * @property $parentRule
 * @property $parentStyleSheet
 * @property $type
 */
class igs_CSSRule
{
    const STYLE_RULE     = 0x01;
    const MEDIA_RULE     = 0x02;
    const FONT_FACE_RULE = 0x03;
    const PAGE_RULE      = 0x04;
    const IMPORT_RULE    = 0x05;
    const CHARSET_RULE   = 0x06;
    const UNKNOWN_RULE   = 0x07;
}

/**
 * @property $selectorText
 * @property $style
 */
class igs_CSSStyleRule extends igs_CSSRule
{

}

class igs_CSSStyleDeclaration
{}

class igs_CSSParser implements ArrayAccess, Countable, Iterator
{
    protected $buffer;


    public function __construct()
    {}

    public function parseFile($path)
    {}

    public function parseString($string)
    {}

    /**
     * @return integer Number of CSS rules
     */
    public function count()
    {}

    /**
     * @return igs_CSSRule
     */
    public function current()
    {}

    public function valid()
    {}

    public function next()
    {}

    public function key()
    {}

    public function rewind()
    {}
}
