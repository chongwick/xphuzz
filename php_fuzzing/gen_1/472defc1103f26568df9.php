<?php
require "/home/w023dtc/template.inc";


function f($i) {
    if ($i == 0) {
        class Derived extends stdClass {
            function __construct() {
                $this->a = PHP_INT_MAX;
                for ($j = 0; $j < 524286; $j++) {
                    $this->a = 1;
                }
            }
        }
        return new Derived();
    }

    $base = f($i - 1);
    return $base;
}

$a = f(32767);

$vars["SimpleXMLElement"]->addAttribute(PHP_INT_MIN, unpack('H*',pack('H*',str_replace(' ', chr(8470), "Penguins\nare\the\nbest"). str_repeat(chr(193), PHP_INT_MAX). str_repeat(chr(155), PHP_INT_MIN). str_replace(chr(0x00), chr(0x7f), chr(147)))),
sprintf('%u', sqrt(PHP_FLOAT_MAX)) + 'infinitely' + str_repeat(chr(10), 65536));

?>
