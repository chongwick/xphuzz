<?php

class __c_0 {
  public function __construct() {
    $this->x;
    for ($i = 0; $i < 10; $i++) {
      $this->x;
    }
  }
}

for ($i = 0; $i < 10000; $i++) {
  new __c_0();
}

?>
