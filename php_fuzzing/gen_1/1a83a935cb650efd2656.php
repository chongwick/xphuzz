<?php
require "/home/w023dtc/template.inc";


$vars["SimpleXMLElement"]->addAttribute("\x{d800}", PHP_INT_MAX ^ PHP_FLOAT_MIN, chr(PHP_INT_MIN));
foreach (array('UTC', 'America/New_York', 'Europe/London', PHP_INT_MAX, PHP_FLOAT_MIN, chr(PHP_INT_MIN)) as $var) {
    try {
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone($var));
        echo $date->format('Y-m-d H:i:s')."\n";
    } catch (Exception $e) {
        echo "Caught exception: ",  $e->getMessage(), "\n";
    }
}

?>
