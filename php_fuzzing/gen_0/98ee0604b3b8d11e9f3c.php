<?php
class A {
    public function __wakeup() {
        trigger_error('Wakeup', E_USER_ERROR);
    }
}

$a = unserialize('O:1:A:1:{s:1:"A";}'. str_repeat('s:1:"";', 0x10000));
?>
