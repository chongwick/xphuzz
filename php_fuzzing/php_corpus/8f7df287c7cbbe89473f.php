<?php

function foo() {
    $a = array();
    for ($i = 1; $i > -1; $i -= 2) {
        if ($i < count($a)) {
            $a = array();
        }
    }
}

foo();

?>
