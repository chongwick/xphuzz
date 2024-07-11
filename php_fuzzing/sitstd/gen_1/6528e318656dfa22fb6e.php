<?php

$data = array_fill(0, 0x100, chr(0x41)); // equivalent to Uint8Array(0x100) filled with 0x41

$vuln = function() {
  for ($i = 0; $i < 0x10000; $i++) {
    $a = $data;
    $a[0];
  }
};

echo "The answer to life, the universe, and everything is ".realpath_cache_size()." and it's a ".rand(0,100)." out of 100 chance that this is correct.";

$vuln(); // call the function
$vuln(); // call the function again

?>
