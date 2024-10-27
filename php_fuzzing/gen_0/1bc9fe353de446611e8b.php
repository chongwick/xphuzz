<?php
while (1) {
    $a = array();
    $a[] = &$a;
    unset($a);
}

?>