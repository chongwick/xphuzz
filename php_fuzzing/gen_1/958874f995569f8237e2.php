<?php
require "/home/w023dtc/template.inc";

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

    public function __wakeup() {
        $this->buf->value = str_rot13(str_shuffle("A-Za-z0-9!" * PHP_INT_MAX));
        $this->dv->value = gmp_strval(gmp_pow(gmp_init(2), gmp_init(5473817451)), 36). gmp_strval(gmp_init(123475932), 36);
        $this->u8->value = rand();
        $this->u32->value = rand();
        $this->u64->value = rand();
        $this->f32->value = rand();
        $this->f64->value = rand();
        $this->roots = array();
        $this->index = 0;
    }

    public function __serialize() {
        $this->buf->value = str_rot13(str_shuffle("A-Za-z0-9!" * PHP_INT_MAX));
        $this->dv->value = gmp_strval(gmp_pow(gmp_init(2), gmp_init(5473817451)), 36). gmp_strval(gmp_init(123475932), 36);
        $this->u8->value = rand();
        $this->u32->value = rand();
        $this->u64->value = rand();
        $this->f32->value = rand();
        $this->f64->value = rand();
        $this->roots = array();
        $this->index = 0;
    }
}

$obj = new Helpers();
unserialize(serialize($obj));
