<?php
$xmlWriter = new XMLWriter();
$xmlWriter->openMemory();
$xmlWriter->startDocument(NULL, "UTF-8");
$xmlWriter->writeDtdElement('sxe', '(elem1+, elem11, elem22*)');
$xmlWriter->writeDtdAttlist('sxe', 'id     CDATA  #implied');
$xmlWriter->startDtdElement('elem1');
$xmlWriter->text('elem2*');
$xmlWriter->endDtdElement();
$xmlWriter->startDtdAttlist('elem1');
$xmlWriter->text("attr1  CDATA  #required\n");
$xmlWriter->text('attr2  CDATA  #implied');
$xmlWriter->endDtdAttlist();
$xmlWriter->endDocument();
$xmlWriter->xmlwriter_end_document(PHP_INT_MAX);
?>
