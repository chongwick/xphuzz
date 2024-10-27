<?php
for ($i = PHP_INT_MIN; $i <= PHP_INT_MAX; $i++) {
    $gid = posix_getgrgid($i);
}
?>
