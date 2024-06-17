<?php

function f() {
    try {
        $a = str_repeat(chr(0), 100000);
        return $a[0] === chr(0);
    } catch (Exception $e) {
        return true;
    }
}

!f();

?>
