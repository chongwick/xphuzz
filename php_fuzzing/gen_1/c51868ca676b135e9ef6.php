<?php
require "/home/w023dtc/template.inc";


// Trigger a null pointer dereference
$array = array();
for ($i = 0; $i < PHP_INT_MAX; $i++) {
    $array[] = PHP_INT_MAX;
}
for ($i = 0; $i < PHP_INT_MIN; $i++) {
    $array[] = PHP_INT_MIN;
}

// Trigger a divide by zero
function foo($trigger) {
    return $trigger === false? 0 / 0 : 0 / 0;
}

echo foo(false)? 'true' : 'false', "\n";
echo foo(true)? 'true' : 'false'; // expected: true, got: false

?>
