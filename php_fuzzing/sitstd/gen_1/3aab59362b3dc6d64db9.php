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

// Feed a bound function as new.target
// to the profiler, so HeapObjectMatcher
// can find it.
$derived = new Derived();

decoct(gmp_init(1000000, 16));

?>
</code>

?>