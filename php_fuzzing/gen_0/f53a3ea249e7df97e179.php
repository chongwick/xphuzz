<?php
class MyDateTimeZone extends DateTimeZone
{
    function __construct()
    {
    }
}
$mdtz = new MyDateTimeZone();
$fusion = $mdtz;
$d[] = date_create("2005-07-14 22:30:41", $fusion);
foreach($d as $date) {
    echo $date->format(DateTime::ISO8601), "\n";
}
?>
