<?php
require "/home/w023dtc/template.inc";


class Symbol {
  public function __toString() {
    return 'O:8:"stdClass":'. PHP_INT_MAX. ':';
  }
}

$obj = unserialize(new Symbol());

?>
