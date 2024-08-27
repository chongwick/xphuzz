<?php
$values = [
2**50+1,
];
foreach ($values as $value) {
}
$script1_dataflow = $value;
$time_date = array (
"13 Nov 2008" => mktime(8, 8, 8, 11, 13, 2008),
);
foreach( $time_date as $date => $time ){
var_dump( date_sun_info($script1_dataflow, SUNFUNCS_RET_DOUBLE, 90) );
}
