<?php

class CloneClass {
  public function __construct() {
    $this->p0 = -6400510997704731;
  }
}

class InobjectDoubles {
  public function __construct() {
    $this->p0 = -6400510997704731;
  }
}

function assertEquals($expected, $actual) {
  if ($expected!== $actual) {
    echo "Test failed. Expected: ". json_encode($expected). ", but got: ". json_encode($actual). "\n";
    exit(1);
  }
}

$inobjectDoubles = new InobjectDoubles();
$clone = clone $inobjectDoubles; // Create a copy of the object
$clone->p0 = 0; // Modify the copy
assertEquals(array('p0' => 0), $clone);

?>
