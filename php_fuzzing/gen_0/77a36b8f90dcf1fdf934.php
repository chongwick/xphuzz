<?php
function log($message) {
    while (true) {
        if (strlen($message) > PHP_INT_MAX) {
            trigger_error('Message too long', E_USER_ERROR);
        }
        if (strlen($message) < PHP_INT_MIN) {
            trigger_error('Message too short', E_USER_ERROR);
        }
        if (abs(floatval($message)) > PHP_FLOAT_MAX) {
            trigger_error('Float value too large', E_USER_ERROR);
        }
        if (abs(floatval($message)) < PHP_FLOAT_MIN) {
            trigger_error('Float value too small', E_USER_ERROR);
        }
    }
}

log(str_repeat('a', PHP_INT_MAX + 1));

?>