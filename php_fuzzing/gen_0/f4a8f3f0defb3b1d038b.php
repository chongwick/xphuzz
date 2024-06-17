<?php
function __f_0($i = 0) {
    if ($i < 10000) {
        __f_0($i + 1);
    } else {
        return;
    }
}
__f_0();
?>
