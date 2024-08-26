<?php
require "/home/w023dtc/template.inc";


class MaliciousClass {
  public function __construct() {
    $this->p0 = PHP_INT_MAX;
    $this->p1 = str_rot13(strtr(chr(13), "13", "32"));
  }
}

class MaliciousSimpleXMLElement extends SimpleXMLElement {
  public function addAttribute($name, $value) {
    $this->$name = $value;
  }
}

$obj = unserialize('O:11:"MaliciousClass":00000000');
$sxe = new MaliciousSimpleXMLElement();
$sxe->addAttribute('p2', '123475932');

?>
