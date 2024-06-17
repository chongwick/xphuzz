<?php

class Key {
  public function __toString() {
    return 'Symbol';
  }
}

$obj = new stdClass();
$obj->{new Key()};

?>
