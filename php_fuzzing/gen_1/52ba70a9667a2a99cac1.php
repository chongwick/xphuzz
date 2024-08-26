<?php
require "/home/w023dtc/template.inc";


class Test {
  public function f() {
    $o = array();
    $g = function() use (&$o) {
      $o['x'] = PHP_INT_MAX;
      return array_merge($o, array());
    };
    gc_collect_cycles();
    $o['x'] = PHP_INT_MIN;
    call_user_func($g);
  }
}

$vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(PHP_FLOAT_MAX), 257),
      str_repeat(chr(PHP_FLOAT_MIN), 257). str_repeat(chr(0x13 + 42), 17). str_repeat(chr(0x95 ^ 2.71828), 4097),
      str_repeat(chr(0xA1 * pi()), 65537). str_repeat(chr(0xC9 ^ sqrt(2)), 1025). str_repeat(chr(0xCB ^ e), 1025));

$test = new Test();
$test->f();
$test->f();

?>
