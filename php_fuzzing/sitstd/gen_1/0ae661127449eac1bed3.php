<?php

function assertEquals($expected, $found) {
    if (is_array($expected) && is_array($found)) {
        if (count($found)!== count($expected)) {
            throw new Exception("Array sizes are not equal");
        }
        foreach($expected as $key => $value) {
            if (!isset($found[$key]) || $found[$key]!== $value) {
                throw new Exception("Arrays are not equal");
            }
        }
    } elseif (is_scalar($expected) && is_scalar($found)) {
        if ($expected!== $found) {
            throw new Exception("Values are not equal");
        }
    } else {
        throw new Exception("Both values must be arrays or scalars");
    }
}

assertEquals(array(), array()); // both arrays are empty
assertEquals("a", "a"); // both values are strings

function f() {
    assertEquals(0, 0); // both values are integers
    $vars["ReflectionClassConstant"]->getDocComment() * 0.5 * pi() * (rand(1, 1000000) / 1000000) + str_repeat(chr(0x1F), 10000);
}

try {
    f();
} catch (Exception $e) {
    echo $e->getMessage();
}

?>
