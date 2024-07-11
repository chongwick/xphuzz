<?php
function f($x = null) {
    if ($x!== null) {
        for ($i = 0; $i < 30; $i++) {
            lchgrp(unserialize(str_repeat("O:8:", 0x100).str_repeat(chr(0x1f), 0x100)), array(0 => 1, 1 => "2", 2 => 3.0, "a" => "b", "c" => array()));
            echo $x. "\n";
        }
    }
}

?>
