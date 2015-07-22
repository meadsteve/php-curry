<?php

use function MeadSteve\PhpCurry\curry;

require_once __DIR__ . "/vendor/autoload.php";

$add = curry(function ($a, $b) {return $a + $b;});
$addOne = $add(1);
$addTwo = $add(2);

echo $addOne(6) . PHP_EOL;
echo $addTwo(6) . PHP_EOL;