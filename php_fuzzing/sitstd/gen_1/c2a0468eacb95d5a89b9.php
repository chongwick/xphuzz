<?php

function SDD() {
    $h = new class {
        public $h = array();
        public function h() {}
    };
    $h->h[1024] = array();
    $h->h["XXX"] = array();
    $h->h[-1] = array();
    for ($i = 0; $i < 30; $i++) {
        echo "SDD\n";
    }
}

function f($x = null) {
    if ($x!== null) {
        for ($i = 0; $i < 30; $i++) {
            echo $x. "\n";
        }
    }
}

SDD();
f("Function SDD");
SDD();

?>
