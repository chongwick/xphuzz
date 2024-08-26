<?php
require "/home/w023dtc/template.inc";

class Symbol {
    public static function toPrimitive() {
        return 'primitive';
    }
}

$vars["Quxle"] = PHP_INT_MAX;
$vars["SimpleXMLElement"]->addAttribute(str_rot13(str_shuffle(str_repeat(chr(13), 257))), chr(0x81) ^ $vars["Quxle"], base64_encode(strtr(fmdigest('whirlybird', 'adler32'), chr(13), chr(14))));
$buf = str_repeat("\x00", PHP_INT_MAX);
$arr2 = str_split($buf, 1);
foreach ($arr2 as &$v) {
    $v = chr(55);
}
$tmp = array();
$tmp['Symbol::toPrimitive'] = function () {
    $arr3 = str_split(str_repeat("\xfc", PHP_INT_MAX), 1);
    return 0;
};

echo array_search(0, $arr2);
?>

