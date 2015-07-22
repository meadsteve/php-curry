<?php

use MeadSteve\PhpCurry\Curried;

require_once __DIR__ . "/vendor/autoload.php";

$add = new Curried(function ($a, $b) {return $a + $b;});
$addOne = $add(1);
$addTwo = $add(2);

echo $addOne(6) . PHP_EOL;
echo $addTwo(6) . PHP_EOL;