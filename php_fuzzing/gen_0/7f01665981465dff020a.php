<?php
function test() {
    $a = array();
    $a[0] = &$a;
    unset($a);
}
test();

?>