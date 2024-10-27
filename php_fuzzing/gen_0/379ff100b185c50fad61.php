<?php
while (PHP_INT_MAX > 0) {
    $cwd = posix_getcwd();
    $cwd.= str_repeat('a', PHP_INT_MAX);
    posix_getcwd($cwd);
}
?>
