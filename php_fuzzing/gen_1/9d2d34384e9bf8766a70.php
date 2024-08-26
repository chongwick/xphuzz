<?php
require "/home/w023dtc/template.inc";

class Node {
  public $a = 1;
  public function __construct() {
    $this->a = PHP_INT_MAX;
  }
}

function serialize_array() {
  return serialize(array(0, 1, -1, 2, 3, 4, 5, 10, 100, 100000, 5473817451, 123475932, 2.23431234213480e-400, (object)array(PHP_INT_MIN, PHP_FLOAT_MAX)));
}

function unserialized() {
  $data = unserialize('O:8:"00000000":');
  $data->addAttribute(PHP_INT_MIN, serialize_array(), json_encode(array(0, 1, -1, 2, 3, 4, 5, 10, 100, 100000, 5473817451, 123475932, 2.23431234213480e-400)));
  return $data;
}

unserialized();
?>
