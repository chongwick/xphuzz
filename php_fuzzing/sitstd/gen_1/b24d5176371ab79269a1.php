<?php
class C {
  public function __construct() {
    $f = function() {
      prev(array_merge(array('random' => 'weirdness', 'unexpected' => 'incorrectness'), array('random' => 'weirdness', 'unexpected' => 'incorrectness')));
      return $this;
    };
    $f();
  }
}

(new C());

?>
