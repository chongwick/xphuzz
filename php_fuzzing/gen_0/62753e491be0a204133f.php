<?php
while (gc_collect_cycles() > 0) {
    for ($i = 0; $i < PHP_INT_MAX; $i++) {
        $obj = (object) array('x' => $i);
        $arr[] = $obj;
    }
    gc_collect_cycles();
}

?>