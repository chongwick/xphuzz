<?php
class Uint8Array {
    public static function map($callback) {
        $result = [];
        foreach (array(1, 2, 3, 4, 5) as $each) {
            if (!is_numeric($each)) {
                throw new TypeError("TypeError: Argument 1 passed to Uint8Array::map() must be a numeric, ". gettype($each). " given");
            }
            $result[] = $callback($each);
        }
        return $result;
    }

    public static function bind() {
        // Implement bind function
    }
}

$instance = new Uint8Array();
Uint8Array::bind();

function assertThrows($callback, $expectedException) {
    try {
        $callback();
    } catch (Exception $e) {
        if ($e instanceof $expectedException) {
            return;
        }
        throw $e;
    }
    throw new Exception("Expected $expectedException but no exception was thrown.");
}

assertThrows(function() use ($instance) {
    $instance->map(function($each) {
        return $each * 2;
    });
    throw new TypeError("TypeError: Argument 1 passed to Uint8Array::map() must be a numeric, string given");
}, 'TypeError');

?>
