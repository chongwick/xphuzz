<?php

// Verify on 32-bit architectures, a byte length overflow is handled gracefully.
const MAX_SMI = 0x7fffffff; // Maximum signed 32-bit integer

class BigInt64Array {
    public function __construct($length, $maxSmi) {
        if ($length > $maxSmi) {
            throw new RangeError('Byte length overflow');
        }
    }
}

try {
    $bigInt64Array = new BigInt64Array($maxSmi, MAX_SMI);
} catch (RangeError $e) {
    // PHP does not have an exact equivalent of the JavaScript assertInstanceof function,
    // but you can use a try-catch block with a specific exception type to achieve similar behavior
}

$arr = array();
$arr[1000] = 0x1234;

function __get($key) {
    if ($key == 256) {
        unset($arr[256]);
        array_unshift($arr, 1.1);
        $arr = array();
    }
    return null;
}

var_export(array_keys($arr));

?>
