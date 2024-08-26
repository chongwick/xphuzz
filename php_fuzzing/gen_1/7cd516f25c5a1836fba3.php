<?php
require "/home/w023dtc/template.inc";


$vars["SimpleXMLElement"]->addAttribute(
    PHP_INT_MAX. str_repeat(chr(0), 42). "hello world",
    base64_encode(str_repeat(chr(193), 257). str_repeat(chr(155), 17). str_repeat(chr(147), PHP_INT_MIN)) + str_repeat(chr(32), 17) + chr(255),
    str_repeat(chr(161), 65537) + str_repeat(chr(213), 1025) + "randomly concatenated string ". (float) PHP_FLOAT_MIN. chr(42) + str_repeat(chr(1), 65537)
);

f(0);
f(PHP_INT_MAX);
f(PHP_INT_MIN);
f(PHP_FLOAT_MAX);
f(PHP_FLOAT_MIN);
f(0);
f(PHP_INT_MAX);
f(PHP_INT_MIN);
f(PHP_FLOAT_MAX);
f(PHP_FLOAT_MIN);

function f($x) {
  $o = array('a' => 0, 'b' => 0);
  if ($x == 0) {
    $o['a'] = 1;
  } else {
    if ($x <= PHP_INT_MAX) {
      if ($x == PHP_INT_MIN) {
        $o['a'] = 2;
      } else {
        $o['a'] = 1;
      }
    } else {
      if ($x == PHP_FLOAT_MAX) {
        $o['a'] = 2;
      } else {
        $o['a'] = 1;
      }
      $o['b'] = 22;
    }
  }
  return $o['a'];
}

?>
