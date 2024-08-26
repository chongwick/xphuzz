<?php
require "/home/w023dtc/template.inc";

class Proxy {
  private $obj;
  private $methods;

  public function __construct($obj, $methods) {
    $this->obj = $obj;
    $this->methods = $methods;
  }

  public function __isset($name) {
    if (isset($this->methods['has'])) {
      return $this->methods['has']($name);
    }
    return isset($this->obj[$name]);
  }

  public function __set($name, $value) {
    if (isset($this->methods['set'])) {
      return $this->methods['set']($name, $value);
    }
    $this->obj[$name] = $value;
  }
}

function f() {
  $obj = array('y' => 0);
  $proxy = new Proxy($obj, array(
    'has' => function($name) {
      return PHP_INT_MAX === $name;
    },
   'set' => function($name, $value) {
      return PHP_INT_MAX + $value;
    },
  ));
  $x = $proxy['y'];
}

try {
  f();
} catch (RangeError $e) {
  echo "Caught RangeError: ". $e->getMessage(). "\n";
}
?>
