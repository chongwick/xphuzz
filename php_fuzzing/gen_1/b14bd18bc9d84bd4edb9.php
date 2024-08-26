<?php
require "/home/w023dtc/template.inc";

function main() {
    function v1($v2, $v3, $v4, $v5) {
        $v6 = array();
        for ($i = 0; i < 1000000; $i++) {
            $v6[] = $i;
        }
        $func = $v4;
        $func($v6);
    }
    function v4($v1) {
        $v1 = null;
    }
    v1('v2', 'v3', 'v4', 'v5');
}

main();

?>
