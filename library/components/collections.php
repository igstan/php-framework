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
     * @return igs_Collection
     */
    public function map($callback, $arguments = null);

    /**
     * @param callback    $callback
     * @param iterateable $arguments OPTIONAL
     * @return igs_Collection
     */
    public function each($callback, $arguments = null);

    /**
     * @param  callback    $callback
     * @param  mixed       $initialValue OPTIONAL
     * @param  mixed       $initialKey   OPTIONAL
     * @param  iterateable $arguments    OPTIONAL
     * @return mixed
     */
    public function reduce($callback, $initialValue = null, $initialKey = null, $arguments = null);

    /**
     * @param  callback    $callback
     * @param  mixed       $initialValue OPTIONAL
     * @param  mixed       $initialKey   OPTIONAL
     * @param  iterateable $arguments    OPTIONAL
     * @return mixed
     */
    public function reduceRight($callback, $initialValue = null, $initialKey = null, $arguments = null);

    /**
     * @param  callback    $callback
     * @param  iterateable $arguments OPTIONAL
     * @return igs_Collection
     */
    public function filter($callback, $arguments = null);

    /**
     * @param  callback    $callback
     * @param  iterateable $arguments OPTIONAL
     * @return boolean
     */
    public function some($callback, $arguments = null);

    /**
     * @param  callback    $callback
     * @param  iterateable $arguments OPTIONAL
     * @return boolean
     */
    public function every($callback, $arguments = null);

    /**
     * @param  iterateable $iterateable
     * @return igs_Collection
     */
    public function mergeLeft($iterateable);

    /**
     * @param  iterateable $iterateable
     * @return igs_Collection
     */
    public function mergeRight($iterateable);

    /**
     * @return Igs_Collection
     */
    public function reverse();

    /**
     * @return array
     */
    public function toArray();
}

interface igs_Set extends igs_Collection
{}

interface igs_Dictionary extends igs_Collection
{
    /**
     * @return igs_Collection
     */
    public function keys();
}

interface igs_List extends igs_Collection
{}

interface igs_Tuple extends igs_Collection
{}

class igsd_Collection implements igs_Collection
{
    /**
     * @var boolean If true, iterates the collection in reverse
     */
    protected $reversed = false;

    /**
     * @var boolean
     */
    protected $recursive = true;

    /**
     * @var ArrayIterator
     */
    protected $iterateable;

    /**
     * @param mixed   $collectionWannabe
     * @param boolean $recursive
     */
    public function __construct($collectionWannabe, $recursive = true)
    {
        $this->recursive = (boolean)$recursive;
        $this->setIterateable($collectionWannabe);
    }

    /**
     * @param  mixed $collectionWannabe
     * @return igs_Collection
     */
    protected function setIterateable($collectionWannabe)
    {
        if (is_scalar($collectionWannabe)) {
            $collectionWannabe = (array)$collectionWannabe;
        }

        $this->iterateable = new ArrayIterator($collectionWannabe);
        return $this;
    }

    /**
     * @return integer
     */
    public function count()
    {}

    public function offsetExists($offset)
    {
        return $this->iterateable->offsetExists($offset);
    }

    /**
     * @param  mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        $result = $this->iterateable->offsetGet($offset);

        $iterateable = is_array($result);
        $iterateable = $iterateable || $result instanceof Traversable;
        $iterateable = $iterateable || $result instanceof ArrayAccess;

        if ($this->recursive && $iterateable) {
            $class  = get_class($this);
            $result = $class($result);
        }

        return $result;
    }

    /**
     * @param  mixed $offset
     * @param  mixed $value
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->iterateable->offsetSet($offset, $value);
    }

    /**
     * @param  mixed $offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        $this->iterateable->offsetUnset($offset);
    }

    /**
     * @return mixed
     */
    public function current()
    {
        $result = $this->iterateable->current();

        $iterateable = is_array($result);
        $iterateable = $iterateable || $result instanceof Traversable;
        $iterateable = $iterateable || $result instanceof ArrayAccess;

        if ($this->recursive && $iterateable) {
            $class  = get_class($this);
            $result = $class($result);
        }

        return $result;
    }

    /**
     * TODO This method should fix PHP's default behavior to cast numeric
     * values to integers.
     */
    public function key()
    {}

    public function next()
    {}

    public function rewind()
    {}

    public function valid()
    {}

    /**
     * @param  callback    $callback
     * @param  iterateable $arguments OPTIONAL
     * @return igs_Collection
     */
    public function map($callback, $arguments = null)
    {}

    /**
     * @param  callback    $callback
     * @param  iterateable $arguments OPTIONAL
     * @return igs_Collection
     */
    public function each($callback, $arguments = array())
    {
        $result    = array();
        $class     = get_class($this);

        // Uses the associated function of the class  for instantiating
        $arguments = $class($arguments);

        // TODO Check this iteration isn't iterating protected members of the class
        foreach ($this as $key => $value) {
            /*
             * First two arguments of the callback are the value and the key,
             * next follows user supplied arguments.
             */
            $args = array_merge(array($value, $key), $arguments->toArray());
            $result[] = call_user_func_array($callback, $args);
        }

        return new $class($result);
    }

    /**
     * @param  callback    $callback
     * @param  mixed       $initialValue OPTIONAL
     * @param  mixed       $initialKey   OPTIONAL
     * @param  iterateable $arguments    OPTIONAL
     * @return mixed
     */
    public function reduce($callback, $initialValue = null, $initialKey = null, $arguments = null)
    {}

    /**
     * @param  callback    $callback
     * @param  mixed       $initialValue OPTIONAL
     * @param  mixed       $initialKey   OPTIONAL
     * @param  iterateable $arguments    OPTIONAL
     * @return mixed
     */
    public function reduceRight($callback, $initialValue = null, $initialKey = null, $arguments = null)
    {}

    /**
     * @param  callback    $callback
     * @param  iterateable $arguments OPTIONAL
     * @return igs_Collection
     */
    public function filter($callback, $arguments = null)
    {}

    /**
     * @param  callback    $callback
     * @param  iterateable $arguments OPTIONAL
     * @return boolean
     */
    public function some($callback, $arguments = null)
    {}

    /**
     * @param  callback    $callback
     * @param  iterateable $arguments OPTIONAL
     * @return boolean
     */
    public function every($callback, $arguments = null)
    {}

    /**
     * @return igs_Collection
     */
    public function reverse()
    {
        $collection = clone $this;
        $collection->reversed = true;
        $collection->rewind();
        return $collection;
    }
}

/**
 * @return igs_Collection
 */
function igsd_Collection()
{
    return new igsd_Collection;
}

define('igsd_Collection', 'igsd_Collection');
