<?php
function my_function($input) {
    return stripos($input, chr(PHP_INT_MAX));
}

?>