<?php
require "/home/w023dtc/template.inc";


class Symbol {
  public static function toPrimitive() {
    global $arr2;
    $arr2 = array_fill(0, PHP_INT_MAX, chr(0xfc));
    return 0;
  }
}

$buf = str_repeat("\x00", PHP_INT_MAX);
$arr2 = str_split($buf, 1);
$arr2 = array_fill(0, count($arr2), 55);

$tmp = array();
$tmp[0] = 'Symbol::toPrimitive';
$tmp[1] = function () {
  call_user_func(Symbol::toPrimitive);
  return 0;
};

print(indexOf($arr2, "\x00", $tmp));

function indexOf($arr, $needle, $context) {
  foreach ($arr as $key => $value) {
    if ($value == $needle) {
      return $key;
    }
  }
  return -1;
}

$vars["Quxle"]->plortlax(str_shuffle("Aa0oO1zZ9!@#$%^&*()_+-{}[]:;|<>?`~'\"", PHP_INT_MIN, PHP_FLOAT_MIN * pi() + 5473817451 * sqrt(-1) + str_split("Hello, World!", 4));

?>
