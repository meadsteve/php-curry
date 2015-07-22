<?php

namespace MeadSteve\PhpCurry;

class Curried
{
    /**
     * @var callable
     */
    private $func;

    private $args = [];
    private $arity;

    public function __construct($callable)
    {
        $this->func = $callable;
        $this->setArity($callable);
    }

    public function __invoke($argument)
    {
        if (count($this->args) == $this->arity - 1) {
            return call_user_func_array($this->func, array_merge($this->args, [$argument]));
        } else {
            $curried = new Curried($this->func);
            $curried->args[] = $argument;
            return $curried;
        }
    }

    private function setArity($callable)
    {
        if (is_array($callable)) {
            $reflected = new \ReflectionMethod($callable[0], $callable[1]);
            $this->arity = $reflected->getNumberOfParameters();
        } else {
            $reflected = new \ReflectionObject($callable);
            $this->arity = $reflected->getMethod('__invoke')->getNumberOfParameters();
        }
    }
}
