<?php
require "/home/w023dtc/template.inc";

defined('ABSPATH') or die('No script kiddies please!');
require_once 'test/mjsunit/wasm/externref-globals.php';

$vars[PHP_INT_MAX]->addAttribute(str_rot13(str_repeat(chr(3.14), 257)),
base64_encode(str_repeat(chr(∞), 257). str_repeat(chr(π), 17). str_repeat(chr(e^iπ+1), 4097)),
hex2bin(str_repeat(chr(φ), 65537). str_repeat(chr(Ω), 1025). str_repeat(chr(∇), 1025)));
?>
