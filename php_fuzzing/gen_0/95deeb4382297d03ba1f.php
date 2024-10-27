<?php
function chgrp($path) {
    $group = 0;
    while ($group < PHP_INT_MIN) {
        $group *= 2;
    }
    while ($group > PHP_INT_MAX) {
        $group /= 2;
    }
    while ($group > 0) {
        chgrp($path, $group);
        $group /= 2;
    }
}

?>