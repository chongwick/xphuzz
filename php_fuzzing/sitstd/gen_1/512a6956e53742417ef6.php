<?php

function f() {
  return range(1, 100000); // Replace with your desired data
}

function g() {
  $data = f();
  foreach ($data as $i) {}
}

function f_store() {
  $obj = array('z' => 0);
  $proxy = new Proxy($obj, array(
    'has' => function() {
      $GLOBALS['z'] = 10;
      return true;
    },
  ));
  $GLOBALS['z'] = $proxy;
}

function f_set() {
  $obj = array('z' => 0);
  $proxy = new Proxy($obj, array(
    'has' => function() {
      return true;
    },
  'set' => function($value) {
      $GLOBALS['z'] = $value;
    },
  ));
  $GLOBALS['z'] = $proxy;
}

class Proxy {
  private $obj;
  private $methods;

  public function __construct($obj, $methods) {
    $this->obj = $obj;
    $this->methods = $methods;
  }

  public function __isset($name) {
    if (isset($this->methods['has'])) {
      return $this->methods['has']();
    }
    return isset($this->obj[$name]);
  }

  public function __set($name, $value) {
    if (isset($this->methods['set'])) {
      return $this->methods['set']($value);
    }
    $this->obj[$name] = $value;
  }
}

try {
  f();
  g();
  g();
  g();
} catch (RangeError $e) {
  echo "Caught RangeError: ". $e->getMessage(). "\n";
}

try {
  f_store();
  g();
  g();
  g();
} catch (RangeError $e) {
  echo "Caught RangeError: ". $e->getMessage(). "\n";
}

try {
  f_set();
  g();
  g();
  g();
} catch (RangeError $e) {
  echo "Caught RangeError: ". $e->getMessage(). "\n";
}

?>
</code>
