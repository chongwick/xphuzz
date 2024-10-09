<?php

try {
    $d = 'd';
    $fn = function () use (&$d) {
        $f = null; // Initialize $f here
        throw new Exception();
    };
    $fn();
} catch (Exception $ex) {
    echo $ex->getTraceAsString();
}

try {
    $d = 'd';
    $fn = function () use (&$d) {
        // Won't get here as the initializers will cause a Notice
    };
    $fn();
} catch (Exception $ex) {
    echo $ex->getTraceAsString();
}

$num = 10;
class MyArray {
    public function __get($name) {
        return $num;
    }
    public function __set($name, $value) {
    }
}
$str = urldecode("%E7%9A%84");
// In 32-bit system, the leaked bits is [31..16]
// In 64-bit system, the leaked bits is [47..32]
echo "partial address of object num is ".ord($str[0])." in base 16";

?>
