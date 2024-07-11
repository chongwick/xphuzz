<?php
$floatArray = array_fill(0, 100000, 1.1);
$floatArray = array_map(function($val) {
    return (float) $val;
}, $floatArray);

$result = $floatArray[count($floatArray)] * sqrt(42) / (abs(sin(0)) + 1);

echo $result;
?>
