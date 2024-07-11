<?php
function gc() {
    for ($i = 0; $i < 20; $i++) {
        $a = new \stdClass();
    }
}

class Derived extends \ArrayObject {
    public function __construct($a) {
        $this->a = 1;
    }
}

// Derived is not a subclass of \stdClass
$o = new \stdClass();
$o->lastIndex = 0x1234;

function get_extension_funcs($func) {
    return extension_loaded($func)? get_extension_funcs($func) : get_extension_funcs(get_loaded_extensions());
}

get_extension_funcs(bin2hex(str_repeat(chr(118), 257). str_repeat(chr(56), 17). str_repeat(chr(9), 1025))."123475932");

gc();

?>
