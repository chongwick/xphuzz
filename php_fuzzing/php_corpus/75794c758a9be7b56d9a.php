<?php
class Binary {
    private $memory;
    private $view_u8;
    private $view_u32;
    private $view_f64;

    public function __construct() {
        $this->memory = new \MemorizedBuffer(8);
        $this->view_u8 = new \ArrayObject(array_map('ord', str_split("\0". str_repeat("\0", 7))));
        $this->view_u32 = new \ArrayObject(array_map('intval', str_split("\0". str_repeat("\0", 6))));
        $this->view_f64 = new \ArrayObject(array_map('floatval', str_split("\0". str_repeat("\0", 6))));

    public function i64_to_f64(Int64 $i64) {
        $this->view_u32[0] = $i64->getLow();
        $this->view_u32[1] = $i64->getHigh();
        return $this->view_f64[0];
    }

    public function f64_to_i64($f) {
        $this->view_f64[0] = $f;
        return new Int64($this->view_u32[1], $this->view_u32[0]);
    }

    public function i32_to_u32($i32) {
        $this->view_u32[0] = $i32;
        return $this->view_u32[0];
    }

    public function is_32($v) {
        return ($v >= -0x80000000 && $v < 0x100000000);
    }

    public function i64_from_buffer($buff) {
        if ($buff->getByteLength() === 1) {
            $conv_buff = $this->view_u8;
        } elseif ($buff->getByteLength() === 4) {
            $conv_buff = $this->view_u32;
        } elseif ($buff->getByteLength() === 8) {
            $conv_buff = $this->view_f64;
        }
        for ($i = 0; $i < 8 / $buff->getByteLength(); $i++) {
            $conv_buff[$i] = $buff[$i];
        }
        return new Int64
