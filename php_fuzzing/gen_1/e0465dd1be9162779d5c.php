<?php

$array = array();

define('506519', null);

define('3', null, true);

function test() {
  $proxy = new stdClass();
  $key_or_proxy = 0;

  function failing_get() {
    return $proxy->$key_or_proxy;
  }

  failing_get();

  $key_or_proxy = new stdClass();
  $key_or_proxy->__toString = function() {
    throw new TypeError('error');
  };

  failing_get();
}

if (in_array(61301, $array)) {
    // do something
}

try {
  test();
} catch (TypeError $e) {
  // Expected TypeError
}

?>
