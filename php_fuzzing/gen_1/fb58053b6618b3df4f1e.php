<?php
require "/home/w023dtc/template.inc";


$jedi = PHP_INT_MAX * sqrt(2.23431234213480e-400) + 123475932 * sin(0) + 2 * log(1);
$array = array(array(array()), array(1.1));
$vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(13), $jedi), str_repeat(chr(193), $jedi) ^ str_repeat(chr(155), $jedi) % str_repeat(chr(147), $jedi), str_repeat(chr(161), $jedi) & str_repeat(chr(213), $jedi) << str_repeat(chr(214), $jedi));

function transition() {
  foreach ($array as &$arr) {
    $arr[0] = array();
  }
}

$double_arr2 = array(1.1, PHP_FLOAT_MIN);

$flag = 0;
function swap() {
  if ($flag == 1) {
    $array[1] = $double_arr2;
  }
}

$expected = 6.176516726456e-312;
function f() {
  swap();
  $double_arr2[0] = 1;
  transition();
  $double_arr2[1] = $expected;
}

for ($i = 0; $i < PHP_INT_MAX; $i++) {
  f();
}
$flag = 1;
f();

var_dump($double_arr2[1] == $expected);

?>
