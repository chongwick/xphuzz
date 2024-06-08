<?php

class Symbol {
  public static function toPrimitive() {
    global $arr2;
    $arr2 = array_fill(0, 0x800, chr(0xfc));
    return 0;
  }
}

$buf = str_repeat("\x00", 0x10000);
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

?>
