<?php
function evil_function() {
    $max = PHP_INT_MAX;
    $rot13 = str_rot13($max);
    echo $rot13;
}
evil_function();
?>
