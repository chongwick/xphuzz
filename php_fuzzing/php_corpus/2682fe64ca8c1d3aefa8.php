<?php
function opt() {
    $arr = array_fill(0, 3, 0);
    $j = 11;
    for ($i = 0; $i < 100; $i++) {
        if ($i == 90) {
            $i = (string) round($j, 0);
            $arr[$i]++;
            $arr[atan($i)] = 1;
        }
    }
}

function main() {
    for ($i = 0; $i < 100; $i++) {
        opt();
    }
}

main();

?>