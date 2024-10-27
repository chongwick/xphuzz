<?php
function test() {
    $a = array();
    $a[] = array();
    $a[] = $a;
    unset($a[1]);
    return $a;
}
test();

?>