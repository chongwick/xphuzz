<?php
$xmlWriter = new XMLWriter();
$xmlWriter->openMemory();
$xmlWriter->startAttribute();
$xmlWriter->text(str_repeat(chr(0), PHP_INT_MAX));
$xmlWriter->xmlWriter_endAttribute();
$xmlWriter->flush();

?>