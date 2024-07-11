<?php

function __f_2() {
    $__v_1 = array(3);
    $__v_1[0] = 10;
    $__v_1[1] = 15.5;
    $__v_1[2] = 20;
    return $__v_1;
}

$vars = array(__f_2());
session_set_save_handler($vars[array_rand($vars)][mt_rand(0, count($vars[array_rand($vars)])-1)], false);

for ($__v_2 = 0; $__v_2 < 3; $__v_2++) {
    $__v_3 = __f_2();
}

?>
