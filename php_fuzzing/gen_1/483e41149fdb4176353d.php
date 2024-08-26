<?php
require "/home/w023dtc/template.inc";


function bananas() {
    echo str_repeat('pewpewpew', PHP_INT_MAX) * PHP_FLOAT_MAX;
}

bananas();
?>

