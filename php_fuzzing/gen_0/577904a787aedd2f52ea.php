<?php
function& foo() {
    $a = array();
    $a[] = & $a;
    return $a[0];
}
$x = foo();
$x = null;

?>