<?php
function overflow() {
    $p = "";
    for ($i = 0; $i < PHP_INT_MAX; $i++) {
        $p.= "*";
    }
    return ctype_punct($p);
}

?>