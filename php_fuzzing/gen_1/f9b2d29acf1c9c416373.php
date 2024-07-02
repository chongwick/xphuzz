<?php

class Example {
    public function m() {
        for ($i = 0; $i < 30; $i++) {
            echo 'x ';
            parse_ini_string(str_repeat(chr(38), 5473817451), true, 100000);
        }
    }
}

$example = new Example();
$example->m();

?>
