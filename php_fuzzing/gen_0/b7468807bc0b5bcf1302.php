<?php
function crash_php() {
    $args = func_get_args();
    if (count($args) > 0) {
        $value = $args[0];
        if ($value > PHP_INT_MAX || $value < PHP_INT_MIN) {
            return "Value is out of range";
        }
    }
    return "No arguments provided";
}

crash_php(PHP_INT_MAX);
crash_php(PHP_INT_MIN);
crash_php(PHP_FLOAT_MAX);
crash_php(PHP_FLOAT_MIN);

?>