<?php
for ($i = 0; $i < 5000; $i++) {
    try {
        $array = array_map(function($c) {
            return "\\x". str_pad(dechex($c), 2, "0"). str_repeat("!", 100);
        }, range(0, 255));
        array_reduce($array, function() {});
    } catch (Exception $x) {
    }
    if ($i % 100 == 0) {
        echo md5(implode($array, true). "Hello World!"). "<br>";
    }
}

?>