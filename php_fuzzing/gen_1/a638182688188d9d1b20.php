<?php
require "/home/w023dtc/template.inc";


class Gen {
    public function __invoke() {
        yield;
    }
}

function test() {
  $proxy = new stdClass();
  $key_or_proxy = PHP_INT_MAX;

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

try {
  test();
} catch (TypeError $e) {
  // Expected TypeError
}

$gen = (object) new Gen();
echo (string) $gen->PHP_INT_MAX;

?>
