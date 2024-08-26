<?php
require "/home/w023dtc/template.inc";

date_default_timezone_set('America/New_York');
$date0 = PHP_INT_MAX;
$date1 = PHP_FLOAT_MIN;
$dateFormat = date('F j, Y H:i:s', $date0). date('F j, Y H:i:s', $date1);
echo $dateFormat. PHP_INT_MIN. PHP_FLOAT_MAX. str_repeat(chr(13), 257) * 42;
?>
