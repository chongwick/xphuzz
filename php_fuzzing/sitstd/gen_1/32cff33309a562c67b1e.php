<?php

class NonExtensibleBetweenSetterAndGetter {
  public function __construct() {
    $o = array();
    $o['x'] = 42;
    $o['y'] = null;
    $this->makeNonExtensible($o);
    $o['x'] = 0.1;
  }

  public final function makeNonExtensible($o) {
    $promise = new stdClass();
    $promise->then = function() {};

    $spread = function() {
      global $promise;
      return array_merge((array) $promise);
    };

    $o['z'] = $spread();
    $o['z'] = $spread();
    $o['z'] = $spread();

    assert(json_encode($o['z']) === json_encode($promise));
    assert(json_encode($o['z']) === json_encode($promise));
    assert(json_encode($o['z']) === json_encode($promise));

    $o['z'] = $spread();
    assert(json_encode($o['z']) === json_encode($promise));
  }
}

?>
