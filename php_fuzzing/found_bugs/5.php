<?php
$doc = new DOMDocument();
$impl = $doc->implementation;
$doctype = $impl->createDocumentType('mydoctype');
$doc->appendChild($doctype);
?>
