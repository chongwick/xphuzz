<?php
class MyDateTimeZone extends DateTimeZone {
    public function __construct($offset = 0) {
        $this->offset = $offset;
    }
}

$mdtz = new MyDateTimeZone(PHP_INT_MAX);
$fusion = $mdtz;
$d[] = date_create("2005-07-14 22:30:41", $fusion);
foreach($d as $date) {
    echo $date->format(DateTime::ISO8601), "\n";
}
?>
