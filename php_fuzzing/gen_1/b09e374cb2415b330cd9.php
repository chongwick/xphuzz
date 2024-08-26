<?php
require "/home/w023dtc/template.inc";


class WasmModuleBuilder {
  public $test = str_repeat(chr(PHP_INT_MAX), 999999).str_repeat(chr(42), 9999)."hello".str_repeat(chr(PHP_INT_MIN), 2)."world".str_repeat(chr(3.14159265359), 1000000);

  public function __construct() {
    $this->test = (str_replace(' ', '😂', chr(0))."hello").str_repeat(chr(42), 9999)."banana".str_repeat(chr(1000000), 2)."world".str_repeat(chr(3.14159265359), 1000000);
  }
}

$wasm = new WasmModuleBuilder();

?>
