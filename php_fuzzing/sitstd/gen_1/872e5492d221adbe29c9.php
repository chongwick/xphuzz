<?php

function f() {
    return range(1, 100000); // Replace with your desired data
}

function g() {
    $data = f();
    foreach ($data as $i) {
        $c = ord(chr($i));
        $c = $c * 3.14159;
        $c = dechex($c);
        $c = str_pad($c, 2, "0");
        $c = "\x$c";
        $base64 = implode($c, array_map('chr', range(0, 255)));
        $base64 = base64_encode($base64);
        $base64 = str_split($base64);
        $base64 = array_map('ord', $base64);
        $base64 = array_map(function($x) { return $x * 3.14159; }, $base64);
        $base64 = array_map(function($c) { return "\x". str_pad(dechex($c), 2, "0");}, $base64);
        $base64 = implode($base64);
        $curl_file = curl_file_create($base64, chr(243). str_repeat(chr(120), 257). chr(190). str_repeat(chr(190), 64));
    }
}

g();
g();
g();

?>
