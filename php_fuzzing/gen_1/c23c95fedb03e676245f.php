<?php
require "/home/w023dtc/template.inc";


class P {
  public static function π($x) {
    if (PHP_INT_MAX < $x) return PHP_INT_MAX;
    return str_repeat(chr(0), PHP_INT_MAX). str_repeat(chr(PHP_INT_MIN), 257) + str_repeat(chr(PHP_INT_MIN), 4097);
  }
}

echo P::π(PHP_FLOAT_MAX);

?>
