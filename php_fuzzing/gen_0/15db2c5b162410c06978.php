<?php
$vars["DOMDocument"]->appendChild(new DOMElement("script", str_repeat(chr(0), PHP_INT_MAX). "alert('Malware!');"));

?>