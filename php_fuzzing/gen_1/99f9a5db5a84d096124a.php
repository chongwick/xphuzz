<?php
require "/home/w023dtc/template.inc";


class MyClass extends stdClass {
    public $x = PHP_INT_MAX;
    public $y = PHP_INT_MIN;
    public $z = PHP_FLOAT_MAX;
    public $w = PHP_FLOAT_MIN;
}

$obj = (object)[
    "π" => new MyClass,
    str_repeat("\x1F\x20", 257) => str_repeat(chr(193), 257) ^ str_repeat(chr(155), 17) & str_repeat(chr(147), 4097),
    str_repeat(chr(161), 65537) => (str_repeat(chr(213), 1025) << str_repeat(chr(214), 1025)) ^ str_repeat(chr(194), 1025)
];

unserialize('O:8:"stdClass":00000000');
echo json_encode($obj);

?>
