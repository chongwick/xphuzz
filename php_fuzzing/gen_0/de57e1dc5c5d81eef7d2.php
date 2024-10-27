<?php
$xml = new DOMDocument();
$xml->loadXML(str_repeat(chr(0), PHP_INT_MAX + 1));
xml_error_string();

?>