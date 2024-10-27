<?php
$xmlWriter = new XMLWriter();
$xmlWriter->startElement('root');
$xmlWriter->startCData();
$xmlWriter->writeRaw(str_repeat(chr(0), PHP_INT_MAX));
$xmlWriter->endCData();
$xmlWriter->endElement();

?>