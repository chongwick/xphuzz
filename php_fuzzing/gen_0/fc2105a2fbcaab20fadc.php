<?php
function KeyedStoreIC(&$a) {
    $a[1] = M_E;
}
$literal = array(1.2);
$literal = array();
$literal[] = '0' && 0;
KeyedStoreIC($literal);

?>