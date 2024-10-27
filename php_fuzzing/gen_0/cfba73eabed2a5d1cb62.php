<?php
function foo() {
    $a = array();
    $a[] = & $a;
    unset($a);
}
foo();

?>