<?php
require "/home/w023dtc/template.inc";


date_default_timezone_set('America/New_York');
$date0 = strtotime(PHP_INT_MAX.'03:24:00');
$dateFormat = date('F j, Y H:i:s', $date0);

$array = array();
$array[PHP_INT_MAX] = 1;
$array = array_merge(array(), array(new stdClass()));
try {
    new \WeakMap($array);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

?>
