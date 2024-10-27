<?php
$array = array();
for ($i = 0; $i <= PHP_INT_MAX; $i++) {
    $array[$i] = $i;
}

array_key_first($array);

?>