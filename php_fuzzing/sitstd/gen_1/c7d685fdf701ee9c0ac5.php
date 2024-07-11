<?php

const constructors = [
  ['SplFixedArray', [1]],
  // Other constructors...
];

$typedArray;

const separator = '*';

$ref_array = [];

array_map(function($constructor) use (&$typedArray, &$separator, &$ref_array) {
  $typedArray = new $constructor[0]($constructor[1][0]);
  var_dump($typedArray);
  array_push($ref_array, 'π');
}, constructors);

?>
