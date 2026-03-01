<?php
class ClassA {
  public function __construct() {
    $this->p0 = PHP_INT_MAX;
  }
}

class ClassB {
  public function __construct() {
    $this->p0 = PHP_INT_MIN;
  }
}

class ClassC {
  public function __construct() {
    $this->p0 = PHP_FLOAT_MAX;
  }
}

class ClassD {
  public function __construct() {
    $this->p0 = PHP_FLOAT_MIN;
  }
}

class ClassE {
  public function __construct() {
    $this->p0 = 5473817451;
  }
}

function makeTime($a, $b, $c, $d, $e) {
  $hour = (int)$a->p0;
  $minute = (int)$b->p0;
  $second = (int)$c->p0;
  $month = (int)$d->p0;
  $day = (int)$e->p0;
  gmmktime($hour, $minute, $second, $month, $day, $hour);
}

$a = new ClassA();
$b = new ClassB();
$c = new ClassC();
$d = new ClassD();
$e = new ClassE();

makeTime($a, $b, $c, $d, $e);
?>
