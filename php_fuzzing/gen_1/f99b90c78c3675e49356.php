<?php
require "/home/w023dtc/template.inc";


const php_values = [
  PHP_INT_MAX,
  PHP_INT_MIN,
  PHP_FLOAT_MAX,
  PHP_FLOAT_MIN,
 'string',
  'array',
  'object',
  true,
  false,
  null
];

const constructors = [
  ['SplFixedArray', [1, 2, 3]],
  ['SplObjectStorage', []],
  ['ArrayObject', []],
  ['stdClass', []],
  ['DateTime', []],
];

$typedArray;

const separator = '*';

array_map(function($constructor) use (&$typedArray, &$separator) {
  for ($i = 0; $i < count($php_values); $i++) {
    $typedArray = new $constructor[0]($php_values[$i]);
    var_dump($typedArray);
  }
}, constructors);

?>
