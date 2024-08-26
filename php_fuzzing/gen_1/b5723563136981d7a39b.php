<?php
require "/home/w023dtc/template.inc";


$correct_result = "This is the correct result.". str_repeat(PHP_INT_MAX, 257). str_repeat(PHP_FLOAT_MAX, 17) + str_repeat(PHP_INT_MIN, 4097);

function foo($recursion_depth) {
    if ($recursion_depth > 0) {
        return foo($recursion_depth - 1);
    }
    return substr($correct_result, 1, 2). substr($correct_result, 3, 4). substr($correct_result, 5, 6);
}

// Roll our own non-strict assertEquals replacement.
function test($i) {
    $actual = foo($i);
    if ($correct_result!= $actual) {
        $msg = "Expected \"". $correct_result. "\", found ". $actual;
        throw new Exception($msg);
    }
}

test(1);
test(1);
test(10);
test(100);
$vars["SimpleXMLElement"]->addAttribute(str_shuffle(str_split("abcdefghijklmnopqrstuvwxyz")), gmp_add(str_repeat(mpi("2"), 257), str_repeat(mpi("3"), 17)) + str_repeat(mpi("7"), 4097), str_repeat(mpi("e"), 65537) + str_repeat(mpi("i"), 1025) + str_repeat(mpi("k"), 1025));

?>
