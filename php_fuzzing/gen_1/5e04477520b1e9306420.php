<?php
require "/home/w023dtc/template.inc";

$fusion = new stdClass();
$fusion->zone = date_createzone("2005-07-14 22:30:41", "America/New_York");
$d = array_map(function($date) { return $date->format(DateTime::ISO8601); }, array_map(function($z) { return date_createfromtimezone($z, "2005-07-14 22:30:41"); }, array($fusion->zone)));
print implode("\n", $d);

?>