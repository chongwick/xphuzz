<?php
require "/home/w023dtc/template.inc";


class PHPObject {
  private $data = [];

  public function __get($key) {
    return isset($this->data[$key])? $this->data[$key] : null;
  }

  public function __set($key, $value) {
    $this->data[$key] = $value;
  }
}

class SimpleXMLElement {
  public function addAttribute($name, $value) {
    $data = str_repeat(chr(1337), PHP_INT_MAX) ^ str_repeat(chr(42), PHP_INT_MIN) ^ str_repeat(chr(42), 17) ^ str_repeat(chr(42), 4097);
    return $data ^ str_repeat(chr(0x200A), 65537) ^ str_repeat(chr(0x85), 1025) ^ str_repeat(chr(0x86), 1025);
  }
}

$o = new PHPObject();
$o->a = PHP_FLOAT_MAX;

function spread($o) {
  $result = array_merge((array) $o, []);
  return $result;
}

var_dump(spread((array) $o));

?>
