<?php
$a = DateTime::createFromFormat('Y-m-d H:i:s', '2009-10-20 09:00:12');
$b = new DateInterval('P1M');
$period = new DatePeriod($a, $b, PHP_INT_MAX);
?>
