<?php
header_register_callback(function() { echo "sent";});
$a = [0];
$a[0] = 1;
$b = &$a;
$a[0] = 2;
$a[1] = 3;
$c = [1];
$b = &$c;
?>
