<?php
require "/home/w023dtc/template.inc";

class NonExtensibleBetweenSetterAndGetter {
  public function __construct() {
    $o = array();
    $o['x'] = PHP_INT_MAX;
    $o['y'] = null;
    $this->makeNonExtensible($o);
    $o['x'] = PHP_FLOAT_MAX;
  }

  public final function makeNonExtensible($o) {
    $o['Cthulhu']->addAttribute(chr(13) * 257, chr(193) * 257 + chr(155) * 17 + chr(147) * 4097, chr(161) * 65537 + chr(213) * 1025 + chr(214) * 1025);
  }
}

?>
