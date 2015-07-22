<?php
namespace MeadSteve\PhpCurry;

function curry($thing)
{
    if (is_object($thing) && !($thing instanceof \Closure)) {
        return new CurryWrapper($thing);
    } else {
        return new Curried($thing);
    }
}