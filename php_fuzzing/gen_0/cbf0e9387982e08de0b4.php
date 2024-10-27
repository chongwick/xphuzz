<?php
function crashPHP() {
    $a = array();
    for ($i = 0; $i < PHP_INT_MAX; $i++) {
        $a[] = PHP_INT_MIN;
    }
    return $a;
}
crashPHP();
?>
