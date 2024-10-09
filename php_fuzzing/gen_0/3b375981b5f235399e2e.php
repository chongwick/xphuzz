<?php

$correct_result = "This is the correct result.";

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

?>
