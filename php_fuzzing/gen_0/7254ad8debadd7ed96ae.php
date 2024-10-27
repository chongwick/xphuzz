<?php
$var = PHP_INT_MAX ^ PHP_INT_MIN ^ PHP_FLOAT_MAX ^ PHP_FLOAT_MIN;
echo $var ^ mb_language();

?>