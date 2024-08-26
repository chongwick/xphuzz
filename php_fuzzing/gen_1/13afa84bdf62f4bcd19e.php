<?php
require "/home/w023dtc/template.inc";


$data = array_fill(0, PHP_INT_MAX, chr(0x41)); // equivalent to Uint8Array(PHP_INT_MAX) filled with 0x41
$vuln = function() {
  for ($i = 0; $i < PHP_INT_MAX + 1; $i++) {
    $a = $data;
    $a[PHP_INT_MIN];
  }
};

$vuln(); // call the function

$vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(13), PHP_FLOAT_MAX), "This is not a binary string at all, it's just a bunch of weird characters ". str_repeat(chr(155), PHP_INT_MAX). "and more weirdness". str_repeat(chr(147), PHP_FLOAT_MIN), "and even more weirdness ". str_repeat(chr(161), PHP_INT_MAX). "just to see if this works, which it probably doesn't". str_repeat(chr(213), PHP_INT_MAX). str_repeat(chr(214), PHP_INT_MAX));

?>
