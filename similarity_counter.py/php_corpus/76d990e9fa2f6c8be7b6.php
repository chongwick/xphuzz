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

echo array_search(0, $arr2);
?>
