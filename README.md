# php-curry

Created for reasons. Probably slow due to reflection usage so I wouldn't use for anything real.

# Usage

``` php
$add = new Curried(function ($a, $b) {return $a + $b;});
$addOne = $add(1);
$addTwo = $add(2);

echo $addOne(6);
echo $addTwo(6);

```
