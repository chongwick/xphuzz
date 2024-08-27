<?php
$dom = new DOMDocument;
$dom->loadXML('<foo>foo1</foo>');
$nodes = $dom->documentElement->childNodes;
$iter = $nodes->getIterator();
$script1_dataflow = $iter;
clone $script1_dataflow;
?>
