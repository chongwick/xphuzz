<?php
$xmlWriter = new XMLWriter();
$xmlWriter->openUri("/dev/null");
$xmlWriter->startElement("root");
$xmlWriter->text(PHP_INT_MAX);
$xmlWriter->endElement();
$xmlWriter->flush();

?>