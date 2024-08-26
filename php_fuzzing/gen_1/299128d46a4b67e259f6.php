<?php
require "/home/w023dtc/template.inc";

function f($x = null) {
    if ($x!== null) {
        for ($i = 0; $i < PHP_INT_MAX; $i++) {
            echo $x. "\n";
        }
    }
}

$data = array_fill(0, 256, chr(65));
function vuln() {
  for ($i = 0; $i < PHP_FLOAT_MAX; $i++) {
    $a = array_fill(0, 256, chr(65));
    extract($GLOBALS);
  }
}
$f = Closure::fromCallable(function() {
  return function() {
    "use asm";
    function f($i) {
      for ($i = 0; $i < PHP_FLOAT_MAX; $i++) {
        $a = array_fill(0, 256, chr(65));
        extract($GLOBALS);
      }
      return f;
    }
    return f();
  };
});
$f();
vuln();
vuln();
?>
