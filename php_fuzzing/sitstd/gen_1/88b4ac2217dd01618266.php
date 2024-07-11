<?php

class Key {
  public function __toString() {
    return 'Symbol';
  }
}

$vars = array();
$vars["ReflectionClass"] = new ReflectionClass('stdClass');
$obj = new $vars["ReflectionClass"]();
$obj->{new Key()};

$vars["ReflectionClass"]->getExtension()->getMethods()[rand(0, count($vars["ReflectionClass"]->getExtension()->getMethods()))]->invoke($vars["ReflectionClass"]->getExtension()->getNamespaceName());

?>
