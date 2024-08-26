<?php
require "/home/w023dtc/template.inc";


$vars["DOMImplementation"]->createDocument(bin2hex(str_repeat(php_logo_guid(), 257). str_repeat(phpversion(), 17). str_repeat(chr(0x1337), 4097)),
bin2hex(str_repeat(getrandmax(), 257). str_repeat(phpversion(), 17). str_repeat(chr(0x1337), 4097)),
new stdClass())->saveHTML(new stdClass()->myProperty);

?>
