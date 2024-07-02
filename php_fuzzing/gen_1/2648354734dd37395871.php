<?php

// Verify that very large arrays can be constructed.
$array1 = array();
for ($i = 0; $i < 65536; $i++) {
    $array1[] = $i;
}
var_dump(is_array($array1)); // true

$timezones = array(
    'America/New_York',
    'America/Chicago',
    'America/Denver',
    'America/Los_Angeles',
);

foreach ($timezones as $tz) {
  try {
    $date = new DateTime();
    $date->setTimezone(new DateTimeZone($tz));
    echo $date->format('Y-m-d H:i:s').'- '. $tz. "\n";
  } catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
  }
}

?>
