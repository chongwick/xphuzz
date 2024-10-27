<?php
$xml = new XMLWriter();
$xml->openUri("/dev/null");
$xml->startElement("a");
$xml->writeElement("b", PHP_INT_MAX);
$xml->writeElement("c", PHP_INT_MIN);
$xml->writeElement("d", PHP_FLOAT_MAX);
$xml->writeElement("e", PHP_FLOAT_MIN);
$xml->endElement();
$xml->flush();
?>
