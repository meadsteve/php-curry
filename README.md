# php-curry
[![Build Status](https://travis-ci.org/meadsteve/php-curry.svg?branch=master)](https://travis-ci.org/meadsteve/php-curry)

Created for reasons. Probably slow due to reflection usage so I wouldn't use for anything real.

# Usage

``` php
<?php

use function MeadSteve\PhpCurry\curry;

require_once __DIR__ . "/vendor/autoload.php";

# functions can be curried
$add = curry(function ($a, $b) {return $a + $b;});
$addOne = $add(1);
$addTwo = $add(2);

echo $addOne(6) . PHP_EOL;
# 7

echo $addTwo(6) . PHP_EOL;
# 8

# We can also automatically curry all the functions on an object.
$sayer = curry(new Sayer());

$helloSayer = $sayer->say("hello");

echo $helloSayer("steve");
# I say hello to steve

echo $helloSayer("debo");
# I say hello to debo

class Sayer
{
    public function say($thing, $person)
    {
        return "I say $thing to $person" . PHP_EOL;
    }
}

```
