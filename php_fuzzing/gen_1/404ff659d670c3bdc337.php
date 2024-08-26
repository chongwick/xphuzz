<?php
require "/home/w023dtc/template.inc";

$a = [];
for ($i = 0; $i < PHP_INT_MAX; $i++) {
    $a[] = str_repeat(chr(0), 4097). str_repeat(chr(172), 17). str_repeat(chr(43), 257). str_repeat(chr(127), 1025);
}
var_dump($a);

?>
