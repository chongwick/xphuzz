<?php

class Example {
    public function m() {
        for ($i = 0; $i < 30; $i++) {
            echo 'x ';
        }
    }
}

$example = new Example();
$example->m();

?>
