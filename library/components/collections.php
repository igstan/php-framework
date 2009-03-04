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

interface igs_CollectionFactory
{
    /**
     * @param mixed $collectionWannabe
     */
    public function createCollection($collectionWannabe);
}

interface igs_Collection extends ArrayAccess, Countable, Iterator
{
    /**
     * @param callback    $callback
     * @param iterateable $arguments OPTIONAL
     */
    public function map($callback, $arguments = null);

    /**
     * @param callback    $callback
     * @param iterateable $arguments OPTIONAL
     */
    public function each($callback, $arguments = null);

    /**
     * @param callback    $callback
     * @param mixed       $initialValue OPTIONAL
     * @param mixed       $initialKey   OPTIONAL
     * @param iterateable $arguments    OPTIONAL
     */
    public function reduce($callback, $initialValue = null, $initialKey = null, $arguments = null);

    /**
     * @param callback    $callback
     * @param mixed       $initialValue OPTIONAL
     * @param mixed       $initialKey   OPTIONAL
     * @param iterateable $arguments    OPTIONAL
     */
    public function reduceRight($callback, $initialValue = null, $initialKey = null, $arguments = null);

    /**
     * @param callback    $callback
     * @param iterateable $arguments OPTIONAL
     */
    public function filter($callback, $arguments = null);

    /**
     * @param callback    $callback
     * @param iterateable $arguments OPTIONAL
     */
    public function some($callback, $arguments = null);

    /**
     * @param callback    $callback
     * @param iterateable $arguments OPTIONAL
     */
    public function every($callback, $arguments = null);
}

interface igs_Set
{}

interface igs_Dictionary
{}

interface igs_List
{}

interface igs_Tuple
{}

class igsd_Collection implements igs_Collection
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
