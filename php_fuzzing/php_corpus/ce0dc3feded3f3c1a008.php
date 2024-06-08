<?php

$data = array_fill(0, 0x100, chr(0x41)); // equivalent to Uint8Array(0x100) filled with 0x41

$vuln = function() {
  for ($i = 0; $i < 0x10000; $i++) {
    $a = $data;
    $a[0];
  }
};

$vuln(); // call the function
$vuln(); // call the function again

?>
