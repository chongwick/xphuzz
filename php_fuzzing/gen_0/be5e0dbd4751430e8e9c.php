<?php
function array_replace_recursive($a, $b) {
    $c = array();
    foreach ($a as $key => $value) {
        if (isset($b[$key])) {
            if (is_array($value) && is_array($b[$key])) {
                $c[$key] = array_replace_recursive($value, $b[$key]);
            } else {
                $c[$key] = $b[$key];
            }
        } else {
            $c[$key] = $value;
        }
    }
    foreach ($b as $key => $value) {
        if (!isset($a[$key])) {
            $c[$key] = $value;
        }
    }
    return $c;
}

$c = array_fill(0, PHP_INT_MAX, array_fill(0, PHP_INT_MAX, 'a'));
$d = array_fill(0, PHP_INT_MAX, array_fill(0, PHP_INT_MAX, 'b'));
array_replace_recursive($c, $d);

?>