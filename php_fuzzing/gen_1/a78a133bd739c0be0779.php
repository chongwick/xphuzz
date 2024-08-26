<?php
require "/home/w023dtc/template.inc";


$b = array_slice(unserialize('a:100000:{i:0;b:0.0;i:1;N;}'), PHP_INT_MAX);

echo $b[PHP_INT_MIN]; // Output: Fatal error: Uncaught Error: Cannot access offset of type integer on an object of type array

?>
