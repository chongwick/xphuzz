<?php

function main() {
    $v2 = array(13.37);
    $v3 = 9007199254740993;
    $v2 = array();
    $v5 = array_merge($v2, array($v3));
    for ($v9 = 0; $v9 < 100; $v9++) {
        $v11 = new \stdClass();
        $v12 = $v11->$v5;
    }
}

main();

?>
