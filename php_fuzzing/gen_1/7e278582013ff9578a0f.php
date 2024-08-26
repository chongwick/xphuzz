<?php
require "/home/w023dtc/template.inc";


$vars["Eggplant"]->addAttribute(PHP_INT_MAX, bin2hex(PHP_INT_MAX) + 5473817451, PHP_FLOAT_MIN * 0.5 + 123475932 / 2.23431234213480e-400);

$ut8 = array();
$arr = explode(" ", $str = "0061 736d 0100 0000 0109 0260 0000 6001 7f01 7f02 4d05 0365 6e76 0366 6666 0000 0365 6e76 066d 656d 6f72 7902 010a 8002 0365 6e76 0574 6162 6c65 0170 0100 0003 656e 760a 6d65 6d6f 7279 4261 7365 037f 0003 656e 7609 7461 626c 6542 6173 6503 7f00 0302 0101 070a 0106 7371 7561 7265 0001 0a28 0126 0041 8080 a001 41f8 acd1 9101 3602 0010 0041 8080 a001 41f8 acd1 9101 3602 0020 0020 006c 0f0b ");
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

$vars = array();
$vars["DOMImplementation"]->createDocument(str_repeat(chr(211), 4097) + str_repeat(chr(172), 17) + str_repeat(chr(43), 257), str_repeat(chr(127), 1025), new DOMDocumentType());
$serialized_string = 'O:9:"Exception":799999999999999999999999999999999997:{i:0;a:0:{}i:6095700000000000000000062;i:1;i:0;R:2;i:0000000000000000000000000000000000000000000000000000000;R:2;i:10;a:0:{}i:62;i:1;i:0;R:2;i:000000000000000000000000000000000000002;d:031830001014370809133E+0000302;i:3;d:+.00000000000000003333330000000001014370809190295902517005;i:3;d:3E+0000302;i:3;d:+.0000000000000000333333000000000101437080919028095902517005;i:3;a:7:{i:3;d:333000000000000000333333000000000101437080;i:3;d:+.0000000000000000333333000000000101437080919028095902517005;i:3;a:7:';
unserialize($serialized_string);
gc_collect_cycles();
$filler1 = "aaaa";
$filler2 = "bbbb";
var_dump($vars);

?>
