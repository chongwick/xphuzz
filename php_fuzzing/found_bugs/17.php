<?php
define("MAX_64Bit", 9223372036854775807);
define("MAX_32Bit", 2147483647);
$otherVals = array(0, 1, -1, 7, 9, 65, -44, MAX_32Bit, MAX_64Bit);
foreach ($otherVals as $otherVal) {
}
$fusion = $otherVal;
$start = new DateTime('2010-06-07');
$interval = new DateInterval('P1D');
foreach (new DatePeriod($start, $interval, $fusion, DatePeriod::INCLUDE_END_DATE) as $day) {
}
?>
