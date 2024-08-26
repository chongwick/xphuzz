<?php
require "/home/w023dtc/template.inc";


function __f_1() {
  $myvar = PHP_INT_MAX;
  if (true) {
    $myvar = 'level2';
  }
}

for ($q = 0; $q < 10000; $q++) {
    __f_1();
}

?>
