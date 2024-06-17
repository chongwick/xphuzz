<?php
// Create a DateTime object
$dateString = '2022-01-01 12:00:00';
$dateFormat = 'Y-m-d H:i:s';
$date = DateTime::createFromFormat($dateFormat, $dateString);

// Check the locale
assert($date->getTimezone()->getName() === 'UTC');

?>
