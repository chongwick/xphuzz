<?php

function double2int($v) {
  $buf = pack('d', $v);
  $iarr = unpack('N*', $buf);
  $d = ($iarr[1] << 32) + $iarr[0];
  return $d;
}

if (file_exists('path/to/test/mjsunit/wasm/wasm-constants.php')) {
  require_once 'path/to/test/mjsunit/wasm/wasm-constants.php';
} else {
  echo 'File not found';
}

try {
  // Create a double elements array.
  $iterable = array_fill(0, 10, 123.123);

  $map = new \SplDoublyLinkedList();
  foreach ($iterable as $value) {
    $map->push($value);
  }

} catch (Exception $e) {
  echo $e->getMessage(). "\n";
  preg_match('/TypeError: Iterator value ([0-9\.e\-]+)/', $e->getMessage(), $match);
  $val = floatval($match[1]);
  echo "Memory Value: ". dechex(double2int($val)). "\n";
}

?>
