<?php
<code>
<?php

class Base {
  public function __construct() {
    $this->x = 1;
  }
}

class Derived extends Base {
  public function __construct() {
    parent::__construct();
  }
}

$a = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19);

// No direct equivalent to %NormalizeElements() in PHP
// You can sort the array if you want to normalize it
sort($a);

$b = array_slice($a, 19);

$derived = new Derived();

echo $b[4]; // Outputs: 11

?>
</code>

?>