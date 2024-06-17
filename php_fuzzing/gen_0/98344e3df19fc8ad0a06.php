<?php

$validTz = array('UTC', 'America/New_York', 'Europe/London');
foreach ($validTz as $tz) {
    try {
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone($tz));
        echo $date->format('Y-m-d H:i:s')."\n";
    } catch (Exception $e) {
        echo "Caught exception: ",  $e->getMessage(), "\n";
    }
}

?>
