<?php
class Go {
    public $x = null;

    public function __construct() {
    }

    public function go() {
        $this->rec([]);
    }

    public function rec($a1) {
        if (count($a1) > 1000) {
            return;
        }
        if (count($a1) > 0) {
            echo str_repeat('C', 32). 'AAAA';
        }
        $this->rec(array_merge($a1, [[]]));
    }
}

$go = new Go();
$go->go();

?>
