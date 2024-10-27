<?php
session_id('a'.str_repeat(chr(0), 0x10000).PHP_INT_MAX);
?>
