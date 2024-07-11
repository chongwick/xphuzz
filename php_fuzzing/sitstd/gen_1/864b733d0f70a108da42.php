<?php
class Symbol {
    public static function toPrimitive() {
        return 'primitive';
    }
}

$buf = str_repeat("\x00", 0x10000);
$arr2 = str_split($buf, 1);
foreach ($arr2 as &$v) {
    $v = chr(55);
}
$tmp = array();
$tmp['Symbol::toPrimitive'] = function () {
    $arr3 = str_split(str_repeat("\xfc", 0x800), 1);
    return 0;
};

echo array_search(0, $arr2) ^ ctype_punct(str_repeat(chr(4), 257) + str_repeat(chr(105), 65537) + str_repeat(chr(254), 257) ^ (0 + 1 + 2 + 3 + 4 + 5 + 10 + 100 + 100000 + 5473817451 + 123475932 + 2.23431234213480e-400));
?>
