<?php
$data = str_repeat("\x00", PHP_INT_MAX + 1);
getimagesizefromstring($data);
?>
