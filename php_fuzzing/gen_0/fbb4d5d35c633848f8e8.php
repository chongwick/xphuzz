<?php
date_default_timezone_set("Europe/London");
echo date_format(date_create_from_format('Y-m-d H:i:s', str_repeat('a', PHP_INT_MAX)), 'Y-m-d H:i:s');
?>
