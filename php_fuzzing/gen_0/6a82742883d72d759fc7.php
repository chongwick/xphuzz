<?php

function SDD() {
    $h = new class {
        public $h = array();
        public function h() {}
    };
    $h->h[1024] = array();
    $h->h["XXX"] = array();
    $h->h[-1] = array();
}

SDD();
SDD();

?>
