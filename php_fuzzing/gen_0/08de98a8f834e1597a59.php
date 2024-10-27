<?php
$xml_writer = new XMLWriter();
$xml_writer->startElement('d');
$xml_writer->writeDtdElement('e', '', 'SYSTEM', 'file:///'. str_repeat(chr(0), PHP_INT_MAX). ';');
$xml_writer->endElement();

?>