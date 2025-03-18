<?php

function foo(array $x) {
    try {
        $x['symbol'] = 42; // Use quotes for string keys
    } catch (Exception $e) {}
    new \stdClass(); // This line is incorrect, as \Number is not a valid class
}

foo(array());

?>
