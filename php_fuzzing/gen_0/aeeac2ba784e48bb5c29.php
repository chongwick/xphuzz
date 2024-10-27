<?php
echo join("\n", array_map(function($i) {
    return str_repeat('x', $i);
}, array(PHP_INT_MAX, PHP_INT_MIN, PHP_FLOAT_MAX, PHP_FLOAT_MIN)));
?>
