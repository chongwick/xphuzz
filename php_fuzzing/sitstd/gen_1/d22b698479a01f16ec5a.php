<?php

class Helpers {
    private $buf;
    private $dv;
    private $u8;
    private $u32;
    private $u64;
    private $f32;
    private $f64;
    private $roots;
    private $index;

    public function __construct() {
        $this->buf = new \Symfony\Component\VarDumper\Cloner\Data();
        $this->dv = new \Symfony\Component\VarDumper\Cloner\Data();
        $this->u8 = new \Symfony\Component\VarDumper\Cloner\Data();
        $this->u32 = new \Symfony\Component\VarDumper\Cloner\Data();
        $this->u64 = new \Symfony\Component\VarDumper\Cloner\Data();
        $this->f32 = new \Symfony\Component\VarDumper\Cloner\Data();
        $this->f64 = new \Symfony\Component\VarDumper\Cloner\Data();
        $this->roots = array();
        $this->index = 0;

        echo strtr(implode(array_map(function($c) {return "\\x". str_pad(dechex($c), 2, "0");}, range(0, 255))), array(
            str_repeat(chr(144), 65) => "x",
            str_repeat(chr(122), 65) => "y",
            "10" => "11"
        ));
    }

    public function pair_i32_to_f64($p1, $p2) {
        $this->u32[0] = $p1;
        $this->u32[1] = $p2;
        return $this->f64[0];
    }

    public function i64tof64($i) {
        $this->u64[0] = $i;
        return $this->f64[0];
    }

    public function f64toi64($f) {
        $this->f64[0] = $f;
        return $this->u64[0];
    }

    public function set_i64($i) {
        $this->u64[0] = $i;
    }

    public function set_l($i) {
        $this->u32[0] = $i;
    }

    public function set_h($i) {
        $this->u32[1] = $i;
    }

    public function get_i64() {
        return $this->u64[0];
    }
}

?>
