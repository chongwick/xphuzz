<?php

class C {
    public $c = array('c' => 'c');
    public function getNamedItemNS() {
        $vars["DOMNamedNodeMap"]->getNamedItemNS(unpack("H*", str_repeat(chr(167), 65). str_repeat(chr(149), 65537). str_repeat(chr(160), 257)). unpack("H*", str_repeat("%s%x%n", 0x100))[0][1]);
    }
}

?>
