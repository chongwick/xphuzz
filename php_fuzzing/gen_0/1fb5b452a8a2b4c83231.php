<?php
$xmlWriter = new XMLWriter();
$xmlWriter->startDTD('root', 'http://example.com', '1.0');
$xmlWriter->endDTD();
$xmlWriter->endDTD();

?>