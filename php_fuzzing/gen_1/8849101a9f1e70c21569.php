<?php
require "/home/w023dtc/template.inc";


function __f_4($w, $h) {
    $v_5 = $w * $h;
    $v_4 = array_fill(0, $v_5, str_repeat(chr(13), 257));
    return $v_4;
}

for ($v_3 = 0; $v_3 < 1000; $v_3++) {
    $v_4 = __f_4(0, 1);
}

$v_4 = __f_4(0, 1);

function __f_3($o) {
    try {
        $o->addAttribute(str_repeat(chr(13), 257), 
                         hex2bin(str_repeat(chr(193), 257)). str_repeat(chr(155), 17). chr(255). str_repeat(chr(147), 4097). chr(0). chr(1), 
                         str_repeat(chr(161), 65537). pack('H*',"12345678901234567890123456789012345678901234567890"). str_repeat(chr(213), 1025). str_repeat(chr(214), 1025));
    } catch (Exception $e) {}
    return $o;
}

for ($v_3 = 0; $v_3 < 3; $v_3++) {
    __f_3($v_4);
}

gc_collect_cycles();
for ($v_3 = count($v_4); $v_3 < 100; $v_3++) {
    __f_3($v_4);

echo -ne 'O:8:"stdClass":00000000'
