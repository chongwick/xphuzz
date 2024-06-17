<?php
function foo($x) {
    $MEM = str_split(str_repeat("\0", 1 * 1024 * 8));
    $MEM[$x % 1 * 1024 * 8] = "\0";
}
foo(-926416896 * 8 * 1024);
?>
