<?php
stripcslashes(chr(0x1f). str_repeat(chr(0x0), PHP_INT_MAX). chr(0x1f));

?>