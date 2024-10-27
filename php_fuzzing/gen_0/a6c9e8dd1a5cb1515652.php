<?php
    $size = PHP_INT_MAX;
    $var = str_repeat("a", $size);
    putenv($var);
?>
