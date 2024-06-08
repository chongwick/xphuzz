<?php
class Test {
    public function m() {
        for ($i = 0; $i < 30; $i++) {
            echo 'x ';
        }
        echo "\n";
        for ($i = 0; $i < 30; $i++) {
            echo 'x ';
        }
        echo "\n";
        for ($i = 0; $i < 30; $i++) {
            echo 'x ';
        }
        echo "\n";
        for ($i = 0; $i < 30; $i++) {
            echo 'x ';
        }
        echo "\n";
        for ($i = 0; $i < 30; $i++) {
            echo 'x ';
        }
        echo "\n";
        // Reference 201:
        echo 'x ';
    }
}

$t = new Test();
$t->m();

?>