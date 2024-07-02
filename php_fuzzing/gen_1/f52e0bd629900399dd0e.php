<?php
const E = '"use asm";';
$num = 10;
class ArrayLike {
    private $num;
    public function __construct($num) {
        $this->num = $num;
    }
    public function __get($name) {
        if ($name == 0) {
            return $this->num;
        }
        return null;
    }
    public function __set($name, $value) {
        // do nothing
    }
}
$arrayLike = new ArrayLike($num);
$str = urldecode("%E7%9A%84");
echo "partial address of object num is ".ord($str[0])."\n";
function f() {
    // LOCALS
}
f();
?>
