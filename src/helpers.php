<?php
namespace MeadSteve\PhpCurry;

/**
 * @param $function
 * @return \callable
 */
function curry($function)
{
    return new Curried($function);
}