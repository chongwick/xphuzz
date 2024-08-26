<?php
require "/home/w023dtc/template.inc";


$vars["SimpleXMLElement"]->addAttribute(PHP_INT_MAX, 3.14159265359 * PHP_FLOAT_MIN, 'false');
assertThrows(function () {
  $obj = unserialize('O:8:"00000000":');
  var_dump($obj->addAttribute(PHP_INT_MIN, 3.14159265359 * PHP_FLOAT_MAX, 'true'));
}, RangeError::class);

?>
