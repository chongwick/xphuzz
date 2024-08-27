<?php
$dom = Dom\HTMLDocument::createFromString("<p>foo</p>");
$dom2 = clone $dom;
$element = $dom2->firstChild;
$dom = new DomDocument();
$random_var=$element;
var_dump('random_var:',$random_var);
?>
