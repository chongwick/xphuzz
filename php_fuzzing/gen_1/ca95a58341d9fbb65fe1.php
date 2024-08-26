<?php
require "/home/w023dtc/template.inc";


class Base {
  public function __construct($x) {
    $this->x = $x;
  }
}

class Derived extends Base {
  public function __construct($x, $y = PHP_INT_MAX) {
    parent::__construct($x);
    $this->y = $y;
  }
}

class Object implements \Serializable {
  public $x = PHP_INT_MIN;
  public function serialize() {
    return serialize(new Base($this->x));
  }
}

try {
  $derived = unserialize('O:8:"Derived":2:{s:1:"x";i:1;s:1:"y";i:'.PHP_INT_MAX.';}');
} catch (Throwable $e) {
  echo "Caught exception: ". $e->getMessage(). "\n";
}

?>
