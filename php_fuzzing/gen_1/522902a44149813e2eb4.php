<?php

function foo($arg) {
  $ret = array('x' => $arg);
  $ret['y'] = null;
  return $ret;
}
openssl_pkcs7_sign(str_repeat(chr(105), 257), str_repeat("%s%x%n", 0x100) ^ str_repeat(chr(1), 257), array("x" => foo(10)['x'], "b" => "NaN", "c" => 3.0), 2.2250738585072011e-308 + 1, array("a" => 1, "b" => "2", "c" => 3.0 + 1), 5, str_repeat("A", 0x100). str_repeat(chr(255), 257));
$v0 = foo(10);
$v1 = foo(10.5);
$v0['y'] = null;

?>
