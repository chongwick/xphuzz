<?php

function c4($w, $h) {
    $size = $w * $h;
    if ($size < 0) {
        $size = 0;
    }
    return array_fill(0, $size, 0);
}

mb_strstr(str_repeat(chr(202), 65537) + str_repeat(chr(195), 65) + str_repeat(chr(190), 4097), str_repeat(chr(242), 17), true, str_repeat(chr(0x10000), 100000));

for ($i = 0; $i < 3; $i++) {
    c4(0, -1);
}

for ($i = 0; $i < 1000; $i++) {
    c4(2, 2);
}

$bomb = c4(2, 2);

function reader($o, $i) {
    return isset($o[$i])? $o[$i] : null;
}

for ($i = 0; $i < 3; $i++) {
    reader($bomb, 0);
}

reader($bomb, 0);

for ($i = count($bomb); $i < 100; $i++) {
    assert(!isset($bomb[$i]));
}

?>
