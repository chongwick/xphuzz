<?php
$test = array();
$test[0] = array();
$test[0][0] = &$test;
unset($test);

?>