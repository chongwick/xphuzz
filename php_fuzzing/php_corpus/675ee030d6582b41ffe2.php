<?php

class Helpers {
    public $buf;
    public $dv;
    public $u8;
    public $u32;
    public $u64;
    public $f32;
    public $f64;
    public $roots;
    public $index;

    function __construct() {
        $this->buf = new \SplFixedArray(8);
        $this->dv = new \SplFixedArray(8);
        $this->u8 = new \SplFixedArray(8);
        $this->u32 = new \SplFixedArray(8);
        $this->u64 = new \SplFixedArray(8);
        $this->f32 = new \SplFixedArray(8);
        $this->f64 = new \SplFixedArray(8);

        $this->roots = array_fill(0, 0x30000, null);
        $this->index = 0;
    }

    function pair_i32_to_f64($p1, $p2) {
        $this->u32[0] = $p1;
        $this->u32[1] = $p2;
        return $this->f64[0];
    }

    function i64tof64($i) {
        $this->u64[0] = $i;
        return $this->f64[0];
    }

    function f64toi64($f) {
        $this->f64[0] = $f;
        return $this->u64[0];
    }

    function set_i64($i) {
        $this->u64[0] = $i;
    }

    function set_l($i) {
        $this->u32[0] = $i;
    }

    function set_h($i) {
        $this->u32[1] = $i;
    }

    function get_i64() {
        return $this->u64[0];
    }

    function ftoil($f) {
       
