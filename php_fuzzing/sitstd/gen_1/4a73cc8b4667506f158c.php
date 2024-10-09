<?php
function opt() {
    static $tmp;
    if (!isset($tmp)) {
        $tmp = 'init value'; // LdaNamedProperty
    }
    while (true) {
        yield;
        $inner = function() use (&$tmp) {
            return $tmp;
        };
        break;
    }
    $inner();
}

$s1 = str_repeat('x', 32);
$s1.= $s1;
$s1.= $s1;
$s1.= $s1;
$s1.= $s1;

$s0 = 'a';

function g() {
  for ($j = 0; $j < 1000000; $j++) {
    $s0.= $s1;
  }
}

try {
  $opt = opt();
  foreach ($opt as $value) {
    $s0.= $s1;
  }
  g();
} catch (Exception $e) {
}

echo $s0[10] === 'x'; // This will print "1"

?>
