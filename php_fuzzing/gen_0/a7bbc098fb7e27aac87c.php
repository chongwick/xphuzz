<?php
function crash_php() {
    $args = func_get_args();
    foreach ($args as $arg) {
        if (is_float($arg)) {
            $arg = floatval($arg);
            if ($arg == PHP_FLOAT_MAX || $arg == PHP_FLOAT_MIN) {
                return;
            }
        } elseif (is_int($arg)) {
            if ($arg == PHP_INT_MAX || $arg == PHP_INT_MIN) {
                return;
            }
        }
    }
    while (true) {
        // Infinite loop
    }
}
crash_php(PHP_FLOAT_MAX);

?>