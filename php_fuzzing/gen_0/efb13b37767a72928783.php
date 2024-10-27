<?php
class A {
    public function __wakeup() {
        die();
    }
}
unserialize('O:1:"A":');
?>
