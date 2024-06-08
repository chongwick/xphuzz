<?php

$wasmMagic = [0x00, 0x61, 0x73, 0x6d];
$version = [0x01, 0x00, 0x00, 0x00];
$i32const = 0x41;
$i64const = 0x42;
$arrayNewWithRTT = [0xfb, 0x11];
$arrayGet = [0xfb, 0x13];
$rttCanon = [0xfb, 0x30];
$functionKind = 0x00;
$typeSection = 0x01;
$importSection = 0x02;
$functionSection = 0x03;
$exportSection = 0x07;
$codeSection = 0x0a;
$functionType = 0x60;
$arrayType = 0x5e;
$i64Type = 0x7e;

class String {
    public function __construct($str) {
        $this->length = strlen($str);
        $this->str = $str;
    }
    public function wasmBytes() {
        $res = array($this->length);
        for ($i = 0; $i < $this->length; $i++) {
            $res[] = ord($this->str[$i]);
        }
        return $res;
    }
}

$functions = array(
    array('name' => 'run', 'index' => 0)
);

function leb($val) {
    $bytes = array();
    while ($val!= 0) {
        $byte = $val & 0x7f;
        $val >>= 7;
        if ($val) {
            $byte |= 0x80;
        }
        $bytes[] = $byte;
    }
    return array_reverse($bytes);
}

$string = new String('Hello, World!');
$stringBytes = $string->wasmBytes();
$code = array($i64const, 0x00, $i32const,...leb(0x40003fff),...$rttCanon, 0x1,...$arrayNewWithRTT,
