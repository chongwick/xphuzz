<?php
require "/home/w023dtc/template.inc";

$maxVals = [
    'MAX_32Bit' => 2147483647,
    'MAX_64Bit' => 9223372036854775807,
];

$numericVals = [0, 1, -1, 7, 9, 65, -44];
foreach ($numericVals as $val) {
    foreach ($maxVals as $maxVal) {
        // no-op
    }
}

$otherVals = array_merge($numericVals, array_keys($maxVals));

$script1_dataflow = max($otherVals);

$start = new DateTime('2018-12-31 00:00:00');
$interval = new DateInterval('P1M');
$period = new DatePeriod($start, $interval, $script1_dataflow);

?>