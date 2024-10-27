<?php
ob_implicit_flush(true);

while (true) {
    $i = PHP_INT_MAX;
    $f = PHP_FLOAT_MAX;
    $m = PHP_INT_MIN;
    $n = PHP_FLOAT_MIN;
    echo $i. "\n";
    echo $f. "\n";
    echo $m. "\n";
    echo $n. "\n";
    flush();
}
?>
