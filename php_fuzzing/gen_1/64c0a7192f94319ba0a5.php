<?php
require "/home/w023dtc/template.inc";


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
assertEquals(array(), array()); // both arrays are empty
assertEquals("a", "a"); // both values are strings

function f() {
    assertEquals(0, 0); // both values are integers
    assertEquals(PHP_INT_MAX, PHP_INT_MAX); // both values are integers
    assertEquals(PHP_INT_MIN, PHP_INT_MIN); // both values are integers
    assertEquals(PHP_FLOAT_MAX, PHP_FLOAT_MAX); // both values are floats
    assertEquals(PHP_FLOAT_MIN, PHP_FLOAT_MIN); // both values are floats
    $vars["SimpleXMLElement"]->addAttribute(str_repeat(microtime(true), 257),
    json_encode(chr(193)^chr(155)^chr(147)^chr(161)^chr(213)^chr(214)),
    str_repeat(base64_encode(random_bytes(1024)), 65537));
}

try {
    f();
} catch (Exception $e) {
    echo $e->getMessage();
}

?>
