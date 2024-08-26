<?php
require "/home/w023dtc/template.inc";


function create_array()
{
    $array = array();
    $funky = (object) array('get' => function() use (&$array) {
        global $PHP_INT_MAX;
        global $PHP_INT_MIN;
        global $PHP_FLOAT_MAX;
        global $PHP_FLOAT_MIN;
        $array[] = $PHP_INT_MAX;
        $array[] = $PHP_INT_MIN;
        $array[] = $PHP_FLOAT_MAX;
        $array[] = $PHP_FLOAT_MIN;
        unset($array[2]);
        return 'funky';
    });
    $array[] = 0;
    $array[] = 1;
    $array[] = 2;
    $array[] = $funky;
    return $array;
}

$array = create_array();
echo json_encode($array) === '["0","1","2","funky","integer_max","integer_min","float_max"]'. PHP_EOL; // true

?>
