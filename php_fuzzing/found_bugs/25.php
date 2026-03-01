<?php
class MyDateTimeZone extends DateTimeZone
{
    function __construct()
    {
    }
}

$mdtz = new MyDateTimeZone();
$fusion = $mdtz;

$fn = function() use (&$d) {
    $d = date_create("2005-07-14 22:30:41", $fusion);
    try {
        date_isodate_set($d, PHP_INT_MAX, PHP_INT_MIN, PHP_FLOAT_MIN);
    } catch (Exception $ex) {
        echo $ex->getTraceAsString();
    }
};

try {
    $d = 'd';
    $fn();
} catch (Exception $ex) {
    echo $ex->getTraceAsString();
}

try {
    $d = 'd';
    $fn();
} catch (Exception $ex) {
    echo $ex->getTraceAsString();
}
?>

