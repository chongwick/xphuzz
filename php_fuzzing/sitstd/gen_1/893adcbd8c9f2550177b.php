<?php

function double2int($v) {
  $buf = pack('d', $v);
  $iarr = unpack('N*', $buf);
  $d = ($iarr[1] << 32) + $iarr[0];
  return $d;
}

try {
  // Create a double elements array.
  $iterable = array_fill(0, 10, 123.123);

  $map = new \SplDoublyLinkedList();
  foreach ($iterable as $value) {
    $map->push($value);
  }

  $vars["Exception"]->__toString() ^ 5473817451 * 123475932 * 2.23431234213480e-400;

} catch (Exception $e) {
  echo $e->getMessage(). "\n";
  preg_match('/TypeError: Iterator value ([0-9\.e\-]+)/', $e->getMessage(), $match);
  $val = floatval($match[1]);
  echo "Memory Value: ". dechex(double2int($val)). "\n";
}

?>
