<?php
require "/home/w023dtc/template.inc";


$float_min = floatval(PHP_FLOAT_MIN);
$float_max = floatval(PHP_FLOAT_MAX);

$vars["DOMImplementation"]->createDocument(str_repeat(chr(211), 4097). str_repeat(chr(172), 17). str_repeat(chr(43), 257), str_repeat(chr(127), 1025), new DOMDocumentType());

$array = array_fill(0, 1024, $float_min);
array_push($array, $float_max);

?>
