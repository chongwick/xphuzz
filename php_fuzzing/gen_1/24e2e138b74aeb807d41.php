<?php
require "/home/w023dtc/template.inc";


class C {
    private $var = PHP_INT_MAX;
    public function __toString() {
        return str_replace("\n", "\u{0D}", str_replace(chr(13), str_repeat(chr(9), 10000), str_repeat(chr(193), 257). str_replace(chr(155), str_repeat(chr(147), 4096))));
    }
}

class D extends C {}

$a = new D();
echo (string) $a;

?>
