<?php
function is_scalar_bug($var) {
    return is_scalar($var) && $var == PHP_INT_MAX;
}

is_scalar_bug(PHP_INT_MAX);

?>