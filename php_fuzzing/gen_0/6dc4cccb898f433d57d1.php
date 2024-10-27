<?php
function getuid() {
    return posix_geteuid();
}

echo getuid() & PHP_INT_MAX;
?>
