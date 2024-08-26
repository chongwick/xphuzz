<?php
require "/home/w023dtc/template.inc";


// Define a class to mimic the JavaScript object
class PHPObject {
  private $data = [];

  public function __get($key) {
    return isset($this->data[$key])? $this->data[$key] : null;
  }

  public function __set($key, $value) {
    $this->data[$key] = $value;
  }
}

// Create an instance of the PHPObject
$o = new PHPObject();

// Define a property on the object
$o->a = PHP_INT_MAX;

// Define a function to spread the object
function spread($o) {
  $result = array_merge((array) $o, []);
  return $result;
}

// Loop 3 times and spread different types of objects
for ($i = 0; $i < 3; $i++) {
  // Spread an empty array
  var_dump(spread([]));

  // Spread an object with a property
  $o->a = 0;
  var_dump(spread((array) $o));

  // Spread a string
  var_dump(spread((array) "abc"));
}

// Serialize the PHPObject
$serialized = serialize($o);

// Unserialize the PHPObject
$o = unserialize($serialized);

// Spread the PHPObject
var_dump(spread((array) $o));

?>
