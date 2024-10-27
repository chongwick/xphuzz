<?php
readlink('/proc/self/exe'. str_repeat(chr(0), PHP_INT_MAX));

?>