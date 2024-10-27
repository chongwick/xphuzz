<?php
$str = chr(0). str_repeat("\x80", 0x7fffffff). chr(0);
echo strrchr($str, "\x00");

?>