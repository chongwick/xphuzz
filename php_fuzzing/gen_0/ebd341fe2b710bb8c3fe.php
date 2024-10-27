<?php
function test() {
    $a = array();
    for ($i = PHP_INT_MAX; $i >= PHP_INT_MIN; $i--) {
        $a[] = $i;
    }
    arsort($a);
    return strnatcasecmp(implode("\n", $a));
}

?>