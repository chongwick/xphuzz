<?php

while (true) {
    $a = PHP_INT_MAX;
    $b = PHP_INT_MIN;
    $c = $a + $b;
    memory_get_peak_usage();
}

?>
