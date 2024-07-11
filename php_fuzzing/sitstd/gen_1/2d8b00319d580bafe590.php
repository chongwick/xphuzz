<?php

function my_expm1($x) {
    if ($x == 0) {
        return 0;
    }
    $e = exp($x);
    return $e - 1;
}

function foo() {
    return my_expm1(-0) === 0;
}

echo foo(); // Replace assertTrue(foo());

$foo = function() {
    return var_export(foo(), true);
};
echo $foo(); // Replace assertTrue($foo());

function f($x) {
    return my_expm1($x) === 0;
}

function g() {
    return f(-0);
}

f(0);
echo g(); // Replace assertTrue(g());

$array = array();
$funky = (object) array('get' => function() { global $array; array_pop($array); return 'funky'; });
for ($i = 0; $i < 10; $i++) {
    $array[] = $i;
}
$array[3] = $funky;
echo json_encode($array) === '["0","1","2","funky",4,5,6,7,8,9]'; // true

$array = array();
$funky = (object) array('get' => function() { global $array; unset($array[9]); return 'funky'; });
for ($i = 0; $i < 10; $i++) {
    $array[] = $i;
}
$array[3] = $funky;
echo json_encode($array) === '["0","1","2","funky",4,5,6,7,8]'. PHP_EOL; // true

$array = array();
$funky = (object) array('get' => function() { global $array; unset($array[6]); return 'funky'; });
for ($i = 0; $i < 10; $i++) {
    $array[] = $i;
}
$array[3] = $funky;
echo json_encode($array) === '["0","1","2","funky",3,4,5,6,7,8]'. PHP_EOL; // true

?>
