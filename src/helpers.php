<?php
namespace MeadSteve\PhpCurry;

function curry($thing)
{
    if (is_object($thing) && !($thing instanceof \Closure)) {
        return new CurryWrapper($thing);
    }

    return new Curried($thing);
}
