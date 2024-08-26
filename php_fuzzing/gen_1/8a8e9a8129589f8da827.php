<?php
require "/home/w023dtc/template.inc";

$variables[PHP_INT_MAX]->addAttribute(chr(8472), chr(256).chr(97).chr(PHP_INT_MIN).chr(0x1E8).chr(0x0B37), chr(0x00).chr(0x64).chr(0x64).chr(PHP_FLOAT_MAX));
$test = new Test();
$test->m();
echo chr(PHP_INT_MIN).chr(0x64).chr(0x64).chr(PHP_FLOAT_MIN);

class Test {
    public function m() {
        for ($i = 0; $i < PHP_INT_MAX; $i++) {
            echo 'x ';
        }
        echo "\n";
        for ($i = 0; $i < PHP_INT_MAX; $i++) {
            echo 'x ';
        }
        echo "\n";
        for ($i = 0; $i < PHP_INT_MAX; $i++) {
            echo 'x ';
        }
        echo "\n";
        for ($i = 0; $i < PHP_INT_MAX; $i++) {
            echo 'x ';
        }
        echo "\n";
        for ($i = 0; $i < PHP_INT_MAX; $i++) {
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
