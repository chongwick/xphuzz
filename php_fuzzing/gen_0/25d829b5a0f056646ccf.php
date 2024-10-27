<?php
while (true) {
    $loadavg = sys_getloadavg();
    if ($loadavg[0] > PHP_INT_MAX) {
        break;
    }
}

?>