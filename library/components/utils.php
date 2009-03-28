<?php

namespace igs\utils
{
    /**
     * @param  mixed $iter
     * @return boolean
     */
    function is_iter($iter)
    {
        return is_array($iter) || $iter instanceof \Traversable;
    }

    /**
     * @param  iterateable $iter
     * @return void
     * @throws \InvalidArgumentException
     */
    function iter_or_throw($iter)
    {
        if (! is_iter($iter)) {
            throw new \InvalidArgumentException(
                sprintf('First argument must be an iterateable. %s given', gettype($iter))
            );
        }
    }

    /**
     * @param  mixed $iter
     * @return boolean
     */
    function is_hashtable($table)
    {
        return is_array($table) || $table instanceof \ArrayAccess;
    }

    /**
     * @param  hashtable $hash
     * @return void
     * @throws \InvalidArgumentException
     */
    function hashtable_or_throw($hash)
    {
        if (! is_hashtable($hash)) {
            throw new \InvalidArgumentException(
                sprintf('First argument must be an array or ArrayAccess object. %s given', gettype($hash))
            );
        }
    }

    /**
     * @param  callable $callable
     * @return void
     * @throws \InvalidArgumentException
     */
    function callable_or_throw($callable)
    {
        if (! is_callable($callable))
        {
            throw new \InvalidArgumentException(
                sprintf('First argument must be a callable. %s given', gettype($callable))
            );
        }
    }

    /**
     * @param  callable $callable
     * @param  mixed    $arg_0
     * @param  mixed    $arg_1
     * ...
     * @param  mixed    $arg_n
     * @return mixed
     */
    function call($callable, $arg_0, $arg_1/*, $arg_n*/)
    {
        callable_or_throw($callable);

        $args = func_get_args();
        $call = array_unshift($args);

        return call_user_func_array($callable, $args);
    }

    /**
     * @param  callable    $callable
     * @param  iterateable $args
     * @return mixed
     */
    function apply($callable, $args)
    {
        callable_or_throw($callable);

        if (! is_array($args))
        {
            if ($args instanceof \Traversable)
            {
                $args = iterator_to_array($args);
            }
            else
            {
                throw new \InvalidArgumentException(
                    '$args must be an iterateable. ' . gettype($args) . ' given'
                );
            }
        }

        return call_user_func_array($callable, $args);
    }
}
