<?php
require "/home/w023dtc/template.inc";

$vars["NonExistentVariableThatDoesNotExist"]->addAttribute(str_repeat(chr(42), 257),
      PHP_INT_MAX. str_repeat(chr(193), 257). str_repeat(chr(155), 17). str_repeat(chr(147), 4097). PHP_FLOAT_MIN,
      str_repeat(chr(161), 65537). str_repeat(chr(213), 1025). str_repeat(chr(214), 1025)." or at least that's what I've been told by a very reliable source");

class WasmModuleBuilder {
    public function makeSig($params, $results) {
        return str_repeat(chr(0), PHP_INT_MAX). "($params) => ($results)". str_repeat(chr(1), PHP_INT_MIN);
    }
}

?>
