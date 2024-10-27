<?php

function malicious_code() {
    $x = PHP_INT_MAX;
    $y = expm1($x);
    return $y;
}

echo malicious_code();

?>
