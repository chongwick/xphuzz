<?php
require "/home/w023dtc/template.inc";


$vars = array();
$vars["DOMImplementation"]->createDocument(str_repeat(chr(42), 257).str_repeat(chr(155), 17).str_repeat(chr(147), 4097), str_repeat(chr(161), 65537).str_repeat(chr(213), 1025).str_repeat(chr(214), 1025),"");
echo serialize($vars);

?>
