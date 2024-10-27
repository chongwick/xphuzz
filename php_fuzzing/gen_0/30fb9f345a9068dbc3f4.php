<?php
$array1 = array();
$array2 = array();
for($i = 0; $i < PHP_INT_MAX; $i++) {
    $array1[] = $i;
    $array2[] = $i;
}
$result = array_uintersect_uassoc($array1, $array2, function($a, $b) {
    return $a - $b;
});

?>