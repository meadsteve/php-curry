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

    public function __construct($callable, $arity = null)
    {
        if (!is_callable($callable)) {
            throw new \InvalidArgumentException("Curried can only wrap a callable");
        }
        $this->func = $callable;
        $this->setArity($callable, $arity);
    }

    public function __invoke()
    {
        $arguments = func_get_args();
        if (count($this->args) == $this->arity - count($arguments)) {
            return call_user_func_array($this->func, array_merge($this->args, $arguments));
        } else {
            $curried = new Curried($this->func);
            foreach($arguments as $argument) {
                $curried->args[] = $argument;
            }
            return $curried;
        }
    }

    private function setArity($callable, $arity = null)
    {
        if ($arity !== null) {
            $this->arity = $arity;
            return;
        }

        if (is_array($callable)) {
            $reflected = new \ReflectionMethod($callable[0], $callable[1]);
            $this->arity = $reflected->getNumberOfParameters();
        } else {
            $reflected = new \ReflectionObject($callable);
            $this->arity = $reflected->getMethod('__invoke')->getNumberOfParameters();
        }
    }
}
