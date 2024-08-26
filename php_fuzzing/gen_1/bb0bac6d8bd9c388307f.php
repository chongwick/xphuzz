<?php
require "/home/w023dtc/template.inc";


function f() {
    return array_fill(1, PHP_INT_MAX, str_repeat(chr(214), 1025));
}

function g() {
    $data = f();
    foreach ($data as $i => $v) {
        $obj[$i] = (object) array(
            "SimpleXMLElement" => (object) array(
                "@attributes" => array(
                    str_rot13("uifbsvyy") => base64_encode(str_replace(chr(13), chr(255), str_replace(chr(10), chr(254), str_repeat(chr(161), 65537). str_repeat(chr(213), 1025). str_repeat(chr(214), 1025))). str_repeat(chr(193), 257). str_repeat(chr(155), 17). str_repeat(chr(147), 4097))
                )
            )
        );
    }
}

g();
g();
g();

?>
