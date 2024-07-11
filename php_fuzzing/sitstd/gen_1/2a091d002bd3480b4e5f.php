<?php

const magic0 = 2396;
const magic1 = 1972;

// Fill xs with float arrays.
$xs = [];
for ($j = 0; $j < magic0; ++$j) {
    $xs[] = [$j + 0.1];
}

// Sort, but trim the array at some point.
$cmp_calls = 0;
usort($xs, function($lhs, $rhs) {
    $lhs = $lhs? $lhs : [0];
    $rhs = $rhs? $rhs : [0];
    if (++$cmp_calls == magic1) {
        $xs = array_slice($xs, 0, 1);
    }
    return $lhs[0] - $rhs[0];
});

// Define a closure with a reference to an undefined variable
function OrigReproCase() {
  try {
    $f = function($y = []) use (&$x) {
      return [];
    };
    $f();
  } catch (TypeError $e) {
    echo 'OrigReproCase: '. $e->getMessage(). "\n";
  }
}
OrigReproCase();

function SimpleReproCase() {
  try {
    $f = function($y = []) use (&$x) {
      return [];
    };
    $f();
  } catch (TypeError $e) {
    echo 'SimpleReproCase: '. $e->getMessage(). "\n";
  }
}
SimpleReproCase();

?>
