<?php
array_map(function($x) {
    return $x * PHP_INT_MAX;
}, range(PHP_INT_MIN, PHP_INT_MAX));

?>