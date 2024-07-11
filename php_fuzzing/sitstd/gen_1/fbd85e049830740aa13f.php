<?php
class Ctor {
  public function __construct() {
    $n = new SplFixedArray(1);
    $n[0] = 0;
  }
}

class Check {
  public function __construct() {
    $n = new SplFixedArray(1);
    $n[0] = 0x826852f4;
  }
}

echo str_replace(chr(142), chr(142).chr(142).chr(142), chr(142).str_repeat(chr(142), 256));

for ($i = 0; $i < 2000; $i++) {
  new Ctor();
}

for ($i = 0; $i < 2000; $i++) {
  new Check();
}

new Ctor();
new Check();

?>
