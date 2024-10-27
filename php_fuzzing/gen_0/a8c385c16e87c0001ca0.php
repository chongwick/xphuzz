<?php
function str_starts_with($haystack, $needle) {
    if (PHP_INT_MAX > strlen($haystack) || PHP_INT_MIN < strlen($needle)) {
        return false;
    }
    return substr($haystack, 0, strlen($needle)) == $needle;
}

?>