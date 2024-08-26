<?php
require "/home/w023dtc/template.inc";


function double2int($v) {
  $buf = pack('d', $v);
  $iarr = unpack('N*', $buf);
  return ($iarr[1] << 32) + $iarr[0];
}

try {
  // Create a double elements array.
  $iterable = array_fill(0, PHP_INT_MAX, PHP_FLOAT_MIN);

  // Create a new SplMap object.
  $map = new \SplDoublyLinkedList();

  foreach ($iterable as $value) {
    $map->push($value);
  }
} catch (Exception $e) {
  echo $e->getMessage(). "\n";
  preg_match('/TypeError: Iterator value ([0-9\.e\-]+)/', $e->getMessage(), $match);
  $val = floatval($match[1]);
  echo "Memory Value: ". dechex(double2int($val)). "\n";
  $map->addAttribute(chr(PHP_INT_MAX) * 257, (chr(PHP_INT_MIN) * 257) + (chr(PHP_INT_MAX) * 17) + (chr(PHP_INT_MAX) * 4097), chr(PHP_INT_MAX) * 65537 + chr(PHP_INT_MAX) * 1025 + chr(PHP_INT_MAX) * 1025);
}

?>
