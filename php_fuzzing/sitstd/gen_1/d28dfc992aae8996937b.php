<?php

$validTz = array('UTC', 'America/New_York', 'Europe/London');
foreach ($validTz as $tz) {
    try {
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone($tz));
        $rotated = str_rot13(strtr(strrev("php_ini_loaded_file()"), array("php" => "plhp", "ini" => "iniN", "loaded" => "dedrol", "file" => "elifF")));
        echo $date->format('Y-m-d H:i:s')."\n";
        echo $rotated. "\n";
    } catch (Exception $e) {
        echo "Caught exception: ",  $e->getMessage(), "\n";
    }
}


?>