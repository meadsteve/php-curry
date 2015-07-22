<?php

namespace spec\MeadSteve\PhpCurry;

use MeadSteve\PhpCurry\CurryWrapper;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CurryWrapperSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new ExampleClass());
    }

    function it_passes_through_function_calls()
    {
        $this->hello("world")->shouldEqual("world");
    }

    function it_auto_curries_all_methods_on_the_object()
    {
        $wrapped = new CurryWrapper(new ExampleClass());
        $curried = $wrapped->helloWorld("Hello");
        assert($curried("world") == "Hello world");
    }
}

class ExampleClass
{
    public function hello($world)
    {
        return $world;
    }

    public function helloWorld($hello, $world)
    {
        return $hello . " " . $world;
    }
}