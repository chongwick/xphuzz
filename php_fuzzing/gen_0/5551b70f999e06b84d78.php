<?php
function crash_php() {
    $a = array();
    for ($i = PHP_INT_MIN; $i <= PHP_INT_MAX; $i++) {
        $a[] = $i;
    }
    method_exists($a, 'foo');
}
crash_php();

?>