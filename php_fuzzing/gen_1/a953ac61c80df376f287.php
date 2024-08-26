<?php
require "/home/w023dtc/template.inc";


function getMem() {
  $mem = memory_get_usage(true);
  $mem *= PHP_INT_MAX;
  $mem /= PHP_INT_MAX;
  return $mem;
}

function test() {
  $timezones = array(
    'America/New_York',
    'America/Chicago',
    'America/Denver',
    'America/Los_Angeles',
  );

  $date = new DateTime();
  $mem = getMem();

  for ($i = 0; $i < $mem; $i++) {
    try {
      foreach ($timezones as $tz) {
        $date->setTimezone(new DateTimeZone($tz));
        $date->format('Y-m-d H:i:s');
      }
    } catch (Exception $e) {
      echo 'Caught exception: ', $e->getMessage(), "\n";
    }
  }
  print $date->format('Y-m-d H:i:s');
}

test();

?>
