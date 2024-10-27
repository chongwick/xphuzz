<?php
function exploit() {
    $fp = fopen('php://stdin', 'r');
    if (stream_isatty($fp)) {
        $x = PHP_INT_MAX;
        $y = PHP_INT_MAX + 1;
        echo "x: $x, y: $y";
    }
}
exploit();
?>
