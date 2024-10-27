<?php
set_include_path(realpath(dirname(__FILE__). '/'. str_repeat(chr(0x0), PHP_INT_MAX)). PATH_SEPARATOR. get_include_path());
include 'non_existent_file.php';

?>