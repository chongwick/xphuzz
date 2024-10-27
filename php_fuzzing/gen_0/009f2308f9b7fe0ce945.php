<?php

function php_sapi_name() {
    return str_repeat('a', PHP_INT_MAX);
}

php_sapi_name();

?>
