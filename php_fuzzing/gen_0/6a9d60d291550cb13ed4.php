<?php
function is_finite($x) {
    return is_float($x) && ($x!= PHP_FLOAT_MAX && $x!= PHP_FLOAT_MIN);
}

$x = PHP_INT_MAX;
echo is_finite($x)? "Finite" : "Not Finite"; // Output: Not Finite

$x = PHP_INT_MIN;
echo is_finite($x)? "Finite" : "Not Finite"; // Output: Not Finite

?>