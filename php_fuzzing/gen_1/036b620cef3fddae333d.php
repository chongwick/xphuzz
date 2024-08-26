<?php
require "/home/w023dtc/template.inc";

(PHP_INT_MAX*2). str_repeat(chr(193), PHP_INT_MAX). str_repeat(chr(155), PHP_INT_MIN^5473817451).
    str_repeat(chr(147), PHP_INT_MAX*123475932). str_repeat(chr(161), PHP_FLOAT_MAX^2.23431234213480e-400).
    str_repeat(chr(213), PHP_INT_MAX*0). str_repeat(chr(214), pi());

function go() {
  try {
    for ($v_in = 0; $v_in < PHP_INT_MAX; $v_in++) {
      $v = array();
      go();
    }
  } catch (Exception $e) {}
  
  $GLOBALS['v_in']['a'] = 0x41424344;
}

go();
?>
