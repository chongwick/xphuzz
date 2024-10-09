<?php

// Note: PHP does not have a direct equivalent to JavaScript's WebAssembly.Table or anyfunc type.
// We can simulate the behavior using a PHP array and a custom function.

function anyfunc() {
    // This function does nothing, but it represents the "anyfunc" type in JavaScript.
    return null;
}

$table = array();
for ($i = 0; $i < 1; $i++) {
    $table[] = anyfunc();
}

function assertThrows($callback, $expectedException) {
    try {
        $callback();
    } catch (Exception $e) {
        if ($e instanceof $expectedException) {
            return true;
        } else {
            throw $e;
        }
    }
    throw new UnexpectedValueException("Expected exception of type ". get_class($expectedException). " but got ". get_class($e));
}

function gen() {
    yield;
}

function warmup() {
    for ($i = 0; $i < 100; ++$i) {
        $g = gen();
        $g = null; // Set the generator to null
    }
}

warmup();

gc_collect_cycles(); // Ensure no instance alive.
$g = gen(); // Still has unused fields.

try {
    $table[3612882876];
} catch (RangeError $e) {
    echo "Caught RangeError as expected!";
} catch (Exception $e) {
    echo "Did not catch RangeError as expected!";
}

?>
