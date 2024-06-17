<?php

function __f_6214($__v_25662) {
    // Use the reduce method on the array
    $initial = 0;
    $result = array_reduce($__v_25662, function($carry, $item) use (&$initial) {
        $initial = $carry + $item;
        return $initial;
    });
    return $initial;
}
echo __f_6214(array(0, 1.8));
echo __f_6214(array(0, 1.8));

?>
