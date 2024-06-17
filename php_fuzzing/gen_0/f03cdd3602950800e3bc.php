<?php

function v0() {
    $v7 = -4294967295;
    try {
        for ($v11 = 0; $v11 < 8; $v11++) {
            $v13 = 'Symbol.isConcatSpreadable';
            $v14 = $v11 && $v13;
            $v15 = $v7 <= $v14;
            for ($i = 0; $i < 10; $i++) {}
        }
    } catch (Exception $v20) {}
}

v0();
v0();
v0();

?>
