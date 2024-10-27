<?php
function crash() {
    $i = PHP_INT_MAX;
    while (true) {
        $i++;
    }
}

crash();

?>