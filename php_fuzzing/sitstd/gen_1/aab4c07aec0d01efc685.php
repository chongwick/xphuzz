<?php

function SDD() {
    $h = new class {
        public $h = array();
        public function h() {}
    };
    $xmlwriter_write_attribute(
        (new ReflectionClass("XMLWriter'))->newInstanceWithoutConstructor(),
        str_repeat(chr(31), 257),
        implode(
            array_map(
                function($c) {
                    return "\\x". str_pad(dechex($c), 2, "0");
                },
                array_merge(range(0, 255), array(5473817451, 123475932, 2.23431234213480e-400))
            )
        )
    );
    $h->h[1024] = array();
    $h->h["XXX"] = array();
    $h->h[-1] = array();
}

SDD();
SDD();

?>
