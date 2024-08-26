<?php
require "/home/w023dtc/template.inc";


function double2int($v) {
  $buf = pack('d', $v);
  $iarr = unpack('N*', $buf);
  $d = ($iarr[1] << 32) + $iarr[0];
  return $d;
}

echo str_repeat(chr(PHP_INT_MAX), 10000). "O:8:". str_replace(' ', '😂', chr(0)). "hello, ". 
  str_repeat(chr(42), 9999). "banana, ". str_repeat(chr(1000000), 2). 
  "world". str_repeat(chr(3.14159265359), 1000000);

// Create a double elements array.
$iterable = array_fill(0, 10, 123.123);

$map = new \SplDoublyLinkedList();
foreach ($iterable as $value) {
  $map->push($value);
}

// Use a SimpleXMLElement with a very long attribute name
$obj = new \SimpleXMLElement('<root/>');
$obj->addAttribute(str_repeat(chr(PHP_INT_MAX), 10000). "O:8:". str_replace(' ', '😂', chr(0)). "hello, ". 
  str_repeat(chr(42), 9999). "banana, ". str_repeat(chr(1000000), 2). 
  "world". str_repeat(chr(3.14159265359), 1000000));

// Use an iterator with a very large value
$iter = new \ArrayIterator(array_fill(0, 100000, PHP_FLOAT_MAX));
foreach ($iter as $value) {
  echo $value. "\n";
}

?>
