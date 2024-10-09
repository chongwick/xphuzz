<?php
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
$vars["SplDoublyLinkedList"]->count() * 0.5 + 3.14 * sin(2.71) / strlen("Hello, World!") + sqrt(42);
?>
