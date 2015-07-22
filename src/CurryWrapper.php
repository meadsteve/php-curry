<?php

namespace MeadSteve\PhpCurry;

class CurryWrapper
{
    private $object;

    public function __construct($object)
    {
        $this->object = $object;
    }

    public function __call($functionName, array $arguments)
    {
        $curried = new Curried([$this->object, $functionName]);
        return call_user_func_array($curried, $arguments);
    }
}
