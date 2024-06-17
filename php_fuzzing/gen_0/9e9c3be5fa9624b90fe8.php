<?php

function main() {
    function v1($v2, $v3, $v4, $v5) {
        $func = $v4;
        $func($v2, $v3, $v5);
    }
    function v4($v1, $v2, $v3) {
        // your code here
    }
    v1('v2', 'v3', 'v4', 'v5');
}

main();

?>
