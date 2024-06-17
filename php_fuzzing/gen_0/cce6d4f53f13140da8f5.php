<?php

class Ctor {
  public function __construct() {
    $this->n = new SplFixedArray();
  }
}

class Check {
  public function __construct() {
    $this->n = 0x826852f4;
  }
}

for ($i = 0; $i < 2000; $i++) {
  new Ctor();
}

for ($i = 0; $i < 2000; $i++) {
  new Check();
}

new Ctor();
new Check();

?>
