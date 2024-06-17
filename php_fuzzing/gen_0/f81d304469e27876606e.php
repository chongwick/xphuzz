<?php

class Symbol {
    public function symbol() {
        echo "Symbol called\n";
    }
}

$v = new Symbol();

function f($v) {
    for ($i = 0; $i < 2; $i++) {
        try {
            $v->symbol();
        } catch (Exception $e) {}
    }
}

f($v);

?>
