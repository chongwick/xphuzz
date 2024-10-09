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
    $splDoublyLinkedList = new \SplDoublyLinkedList();
    $splDoublyLinkedList->key() = 5473817451.23423412341234e-400;
  }
}

?>
