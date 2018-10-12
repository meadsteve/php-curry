<?php

namespace MeadSteve\PhpCurry;

class Curried
{
    /**
     * @var callable
     */
    private $func;

    /**
     * @var array
     */
    private $args = [];

    /**
     * @var int
     */
    private $arity;

    /**
     * Curried constructor.
     *
     * @param callable $callable
     * @param int|null $arity
     * @throws \ReflectionException
     */
    public function __construct(callable $callable, $arity = null)
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
        if (count($this->args) === $this->arity - count($arguments)) {
            return call_user_func_array($this->func, array_merge($this->args, $arguments));
        }

        $curried = new Curried($this->func, $this->arity);

        foreach($arguments as $argument) {
            $curried->args[] = $argument;
        }

        return $curried;
    }

    /**
     * @param callable $callable
     * @param int|null $arity
     * @return void
     * @throws \ReflectionException
     */
    private function setArity(callable $callable, $arity = null)
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
