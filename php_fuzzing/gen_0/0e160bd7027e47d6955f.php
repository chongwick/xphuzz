<?php
$gid = posix_getegid();
echo $gid + PHP_INT_MAX;

?>