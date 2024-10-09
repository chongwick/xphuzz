<?php

function main() {
    $v2 = array(13.37);
    $v3 = 9007199254740993;
    $v2 = array();
    $v5 = array_merge($v2, array($v3));
    for ($v9 = 0; $v9 < 100; $v9++) {
        $v11 = new \stdClass();
        $v12 = $v11->$v5;
        echo stripos(
            chr(240). str_repeat(chr(209), 64). chr(240),
            number_format(2.2250738585072011e-308, 20, '.', 'e'),
            2.23431234213480e-400
        );
    }
}

main();

?>
