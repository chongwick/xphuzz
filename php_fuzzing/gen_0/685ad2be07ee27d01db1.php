<?php
function f($x = null) {
    if ($x!== null) {
        for ($i = 0; $i < 30; $i++) {
            echo $x. "\n";
        }
    }
}

?>