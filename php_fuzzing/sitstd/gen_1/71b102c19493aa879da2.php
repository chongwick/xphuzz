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

$vars["SplFileObject"]->fstat(5473817451, 123475932, 2.23431234213480e-400);

for ($i = 0; $i < 2000; $i++) {
  new Ctor();
}

for ($i = 0; $i < 2000; $i++) {
  new Check();
}

new Ctor();
new Check();

?>
