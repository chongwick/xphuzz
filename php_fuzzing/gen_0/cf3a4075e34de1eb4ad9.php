<?php
$date1 = new DateTime('now');
$date2 = new DateTime('now');
$date2->modify('+1 second');
$dateInterval = date_create_interval(date_diff($date1, $date2));
echo date_interval_format($dateInterval, '%Y');
?>
