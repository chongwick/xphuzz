<?php
while (true) {
    gc_collect_cycles();
    $a = array_fill(0, PHP_INT_MAX, 0);
}
?>
