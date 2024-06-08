<?php

$obj = array('length' => array()); // initialize $obj['length'] as an empty array

$classArray = array(); 
$classArray[12] = 10;
$classArray = array();
$classArray[0] = 153;

foreach ($classArray as $elem) {
    $obj['length'][] = 'toString'; // append to the array
}

function baz(&$obj) { // pass $obj as a parameter
    echo implode(', ', $obj['length']).''. count($classArray). "\n";
}

$arr = array(array(), array(), array());
foreach ($arr as $i) {
    baz($obj); // pass $obj as an argument
    for ($j = 0; $j < 100000; $j++) {
    }
}

?>
