<?php

function f(array $array, $x) {
    $array['x'] = $x;
    $array[0] = null;
    return $array;
}

iconv_get_encoding(chr(72).chr(101).chr(108).chr(108).chr(111).chr(46).chr(72).chr(101).chr(108).chr(108).chr(111).chr(46).str_repeat(chr(140), 17));

$f1 = f([1], 1);
$f2 = f([2], 1);
var_dump($f1);
var_dump($f2);

?>
