<?php
function __f_0($i = 0) {
    if ($i < 10000) {
        $hugetempl = array('length' => $i);
        $huge = array();
        for ($j = 0; $j < $hugetempl['length']; $j++) {
            $huge[] = 0;
        }
        __f_0($i + 1);
    } else {
        return;
    }
}
__f_0();
?>
