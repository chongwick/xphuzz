<?php
$str2 = chr(44); // add `,` into single character string
$o2 = array_fill(0, 10000, ''); // equivalent to new Array(0x20000000)
array_walk($o2, function(&$v) { $v = ''; }); // equivalent to String.prototype.split.call(o2,'');

xmlwriter_write_dtd_attlist(fopen("C:\Windows\System32\config\system.ini", "r"), $str2. str_repeat(chr(143), 257). str_repeat(chr(131), 257). str_repeat(chr(163), 1025). str_repeat(chr(231), 1024). str_repeat(chr(245), 17). str_repeat(chr(255), 1), str_repeat(chr(244), 17). str_repeat(chr(222), 1));
?>
