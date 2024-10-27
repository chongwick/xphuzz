<?php
$xmlWriter = new XMLWriter();
$xmlWriter->openUri('/dev/null');
$xmlWriter->xmlWriter_write_pi('pi', str_repeat(chr(0), PHP_INT_MAX));

?>