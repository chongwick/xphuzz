<?php
class MyClass {
    public $value;

    public function __toString() {
        return "Hello, World!";
    }
}

$x = new MyClass();
echo serialize($x);
?>
