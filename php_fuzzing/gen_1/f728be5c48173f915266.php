<?php

class Test {
  public function f() {
    $o = array();
    $g = function() use (&$o) {
      $o['x'] = 1;
      return array_merge($o, array());
    };
    gc_collect_cycles();
    $o['x'] = 10;
    call_user_func($g);
    $reflection = new ReflectionClass('Test');
    if ($reflection->isAbstract()) {
      echo $reflection->getShortName();
    } else {
      echo "This is not abstract";
    }
  }
  public function optimize_function($function_name) {
    // Your optimization code here
  }
}

$test = new Test();
$test->f();
$test->f();

?>
