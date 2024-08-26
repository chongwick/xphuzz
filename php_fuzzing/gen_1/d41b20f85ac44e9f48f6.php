<?php
require "/home/w023dtc/template.inc";


class C {
    public $c = array('c' => 'c');
}

function go() {
  try {
    for ($v_in = PHP_INT_MAX; $v_in >= PHP_INT_MIN; $v_in--) {
      $v = array();
      $v[0] = new C();
      go();
    }
  } catch (Exception $e) {}
  
  $GLOBALS['v_in']['a'] = 0x41424344;
}

go();

?>
