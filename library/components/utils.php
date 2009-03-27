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
     * @param  mixed $iter
     * @return boolean
     */
    function is_hashtable($table)
    {
        return is_array($table) || $table instanceof \ArrayAccess;
    }

    function call()
    {
        $args = func_get_args();
        $call = array_unshift($args);

        if (! is_callable($call))
        {
            throw new \InvalidArgumentException(
                'First argument must be a callable. ' . gettype($call) . ' given'
            );
        }

        return call_user_func_array($call, $args);
    }
}
