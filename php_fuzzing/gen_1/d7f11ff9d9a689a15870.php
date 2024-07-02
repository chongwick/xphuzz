<?php
<code>
<?php
echo ini_get('include_path');
$vars["DOMDocument"]->createElementNS(str_repeat(chr(5), 65537). str_repeat(chr(32), 1024). "hello", 
str_repeat("A", 0x100). "B". str_repeat(chr(1), 255). chr(0). str_repeat(chr(255), 255), 
implode(array_map(function($c) {return "\\x". str_pad(dechex($c), 2, "0"). chr(255);}, range(0, 255))));
?>
</code>

?>