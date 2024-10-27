<?php
$xmlWriter = new XMLWriter();
$xmlWriter->startDTD('entity', '', '');
$xmlWriter->startEntity('entity');
$xmlWriter->text(str_repeat(chr(0), PHP_INT_MAX));
$xmlWriter->endEntity();
$xmlWriter->endDTD();

?>