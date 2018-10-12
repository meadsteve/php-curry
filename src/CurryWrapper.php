<?php

namespace MeadSteve\PhpCurry;

class CurryWrapper
{
    /**
     * @var mixed
     */
    private $object;

    /**
     * CurryWrapper constructor.
     *
     * @param mixed $object
     */
    public function __construct($object)
    {
        $this->object = $object;
    }

    /**
     * @param string $functionName
     * @param array  $arguments
     * @return mixed
     * @throws \ReflectionException
     */
    public function __call($functionName, array $arguments)
    {
        $curried = new Curried([$this->object, $functionName]);

        return call_user_func_array($curried, $arguments);
    }
}
