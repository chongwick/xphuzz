<?php
class A {
    public function __wakeup() {
        while (1) {
            $x = array();
        }
    }
}

$a = unserialize('O:1:"A":1:{s:4:"__w";}

?>