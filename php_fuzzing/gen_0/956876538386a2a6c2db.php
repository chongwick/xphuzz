<?php
$xmlWriter = new XMLWriter();
$xmlWriter->openUri('/dev/urandom');
$xmlWriter->startDocument(PHP_INT_MAX, '1.0', 'UTF-8');

?>