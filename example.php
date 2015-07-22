<?php

use function MeadSteve\PhpCurry\curry;

require_once __DIR__ . "/vendor/autoload.php";

# functions can be curried
$add = curry(function ($a, $b) {return $a + $b;});
$addOne = $add(1);
$addTwo = $add(2);

echo $addOne(6) . PHP_EOL;
echo $addTwo(6) . PHP_EOL;

# We can also automatically curry all the functions on an object.
$sayer = curry(new Sayer());

$helloSayer = $sayer->say("hello");

echo $helloSayer("steve");
echo $helloSayer("debo");

class Sayer
{
    public function say($thing, $person)
    {
        return "I say $thing to $person" . PHP_EOL;
    }
}