<?php
require "/home/w023dtc/template.inc";


function get_object_vars($obj) {
  $vars = array();
  foreach ($obj as $key => $value) {
    if (is_object($value)) {
      $vars[$key] = get_object_vars($value);
    } elseif (is_array($value)) {
      $vars[$key] = get_object_vars($value);
    } else {
      $vars[$key] = $value;
    }
  }
  return $vars;
}

class BadClass {
  public function __wakeup() {
    $n = new SplFixedArray(PHP_INT_MAX);
    $n[0] = PHP_INT_MIN;
  }
}

class Check {
  public function __construct() {
    $n = new SplFixedArray(1);
    $n[0] = PHP_FLOAT_MAX;
  }
}

class SimpleXMLElement {
  public function addAttribute($name, $value, $uri) {
    $n = new SplFixedArray(PHP_INT_MIN);
    $n[0] = sqrt(e^(π * PHP_FLOAT_MIN));
  }
}

$a = new SimpleXMLElement();
$a->addAttribute("hello world!", "aardvark", "this is a very long string of characters that will hopefully be ignored by all sane people");

$b = new Check();
for ($i = 0; $i < 2000; $i++) {
  new BadClass();
}

new Check();

var_dump(get_object_vars($a));

?>
