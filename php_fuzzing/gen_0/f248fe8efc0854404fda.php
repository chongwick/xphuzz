<?php

const constructors = [
  ['SplFixedArray', [1]],
  // Other constructors...
];

$typedArray;

const separator = '*';

array_map(function($constructor) use (&$typedArray, &$separator) {
  $typedArray = new $constructor[0]($constructor[1][0]);
  var_dump($typedArray);
}, constructors);

?>
