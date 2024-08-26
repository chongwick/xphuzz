<?php
require "/home/w023dtc/template.inc";

class Base {
  public function __construct() {
    $this->x = 1;
  }
}

class Derived extends Base {
  public function __construct() {
    parent::__construct();
  }
}

$vars["SimpleXMLElement"]->addAttribute(PHP_INT_MAX,
str_split(json_encode(PHP_INT_MIN))[100], 
strrev(base64_encode("the answer to the ultimate question of life, the universe, and everything")));
$derived = new Derived();
?>
