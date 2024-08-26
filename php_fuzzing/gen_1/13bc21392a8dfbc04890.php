<?php
require "/home/w023dtc/template.inc";


function FFF() {
    $h = new class {
        public $h = array();
        public function h() {}
    };
    $h->h[PHP_INT_MAX] = array();
    $h->h[PHP_INT_MIN] = array();
    $h->h[PHP_FLOAT_MAX] = array();
    $h->h[PHP_FLOAT_MIN] = array();
}

FFF();

?>
