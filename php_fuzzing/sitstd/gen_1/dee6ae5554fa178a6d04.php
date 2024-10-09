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

class MyTypeError {
    public function __get($name) {
        $this->data = [];
        return $this->data;
    }
}

function f() {
    $e = new MyTypeError();
    assertEquals(array(), $e); // both arrays are empty
    assertEquals("a", "a"); // both values are strings
    assertEquals(0, 0); // both values are integers
}

try {
    f();
} catch (Exception $e) {
    echo $e->getMessage();
}

gc_collect_cycles();

var_dump($e);

?>
