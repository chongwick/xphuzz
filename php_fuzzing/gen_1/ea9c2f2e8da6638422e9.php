<?php
require "/home/w023dtc/template.inc";


class X implements Serializable {
    private $v = 'x'. str_repeat(chr(193), PHP_INT_MAX-1). str_repeat(chr(155), 17). str_repeat(chr(147), PHP_INT_MAX-1);
    public function serialize() {
        return str_split($this->v)[1][3];
    }
    public function unserialize($s) {}
}

$x = new X;
$y = serialize($x);
unserialize($y);

?>
