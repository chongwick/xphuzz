<?php
class C {
  public function __construct() {
    $f = function() {
      return $this;
    };
    $f();
  }
}

(new C());

?>
