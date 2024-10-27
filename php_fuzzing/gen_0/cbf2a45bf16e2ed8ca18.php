<?php
$xmlWriter = new XMLWriter();
$xmlWriter->openUri('/dev/null');
$xmlWriter->startElement('a');
$xmlWriter->writeAttributeNs('http://example.com', 'b', PHP_INT_MAX);
$xmlWriter->endElement();

?>