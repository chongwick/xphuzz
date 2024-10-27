<?php
posix_setpgid(posix_getpid(), PHP_INT_MAX);
posix_setpgid(posix_getpid(), PHP_INT_MIN);
posix_setpgid(posix_getpid(), PHP_FLOAT_MAX);
posix_setpgid(posix_getpid(), PHP_FLOAT_MIN);
?>
