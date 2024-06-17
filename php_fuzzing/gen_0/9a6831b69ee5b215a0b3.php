<?php

// MAKE A RWX MEMORY FROM WASM
$str = "0061 736d 0100 0000 0109 0260 0000 6001 7f01 7f02 4d05 0365 6e76 0366 6666 0000 0365 6e76 066d 656d 6f72 7902 010a 8002 0365 6e76 0574 6162 6c65 0170 0100 0003 656e 760a 6d65 6d6f 7279 4261 7365 037f 0003 656e 7609 7461 626c 6542 6173 6503 7f00 0302 0101 070a 0106 7371 7561 7265 0001 0a28 0126 0041 8080 a001 41f8 acd1 9101 3602 0010 0041 8080 a001 41f8 acd1 9101 3602 0020 0020 006c 0f0b ";

$arr = explode(" ", $str);
$ut8 = array();
$j = 0;
for($i = 0; $i < count($arr); $i++) {
    $ut8[$j++] = (hexdec(substr($arr[$i], 0, 2)) << 4) + hexdec(substr($arr[$i], 2, 2));
    $ut8[$j++] = (hexdec(substr($arr[$i], 4, 2)) << 4) + hexdec(substr($arr[$i], 6, 2));
}

$zz = array();
$flag = 0;
$zz['toString'] = function() {
    return 0x0;
};
function zzz() {
    //imports.env.memory.grow(100);
    $evil_ut[1] = 0x12345678;
}
$imports = array();
$imports['env'] = $imports['env']?? array();
$imports['env']['memoryBase'] = 0x80000;

?>
