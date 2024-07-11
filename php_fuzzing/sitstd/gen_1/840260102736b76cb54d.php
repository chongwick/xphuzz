<?php

function f1($arg) {
    $ret = array('x' => $arg);
    $ret['y'] = null;
    return $ret;
}

function f2($arg) {
    return $arg['x'];
}

$validTz = array('UTC', 'America/New_York', 'Europe/London');
foreach ($validTz as $tz) {
    try {
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone($tz));
        $v1 = f1($date->format('Y-m-d H:i:s'));
        echo f2($v1). "\n";
    } catch (Exception $e) {
        echo "Caught exception: ",  $e->getMessage(), "\n";
    }
}

$v3 = array('z' => '');
$v3['z'] = null;

?>
