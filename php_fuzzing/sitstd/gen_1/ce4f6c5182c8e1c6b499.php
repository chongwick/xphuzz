<?php

function test() {
  $proxy = new stdClass();
  $key_or_proxy = 0;

  function failing_get() {
    return $proxy->$key_or_proxy;
  }

  $encoded = rawurlencode(unpack('H*', pack('C'.4097, 69)).pack('C65', 104));
  failing_get();

  $key_or_proxy = new stdClass();
  $key_or_proxy->__toString = function() {
    throw new TypeError('error');
  };

  failing_get();
}

try {
  test();
} catch (TypeError $e) {
  // Expected TypeError
}

?>
