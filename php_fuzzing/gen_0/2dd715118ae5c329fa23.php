<?php

function push_a_lot(&$arr) {
    for ($i = 0; $i < 20000; $i++) {
        $arr[] = $i;
    }
    return $arr;
}

$arr = array();
$arr = push_a_lot($arr);
echo '<pre>'. print_r($arr, true). '</pre>';

?>
