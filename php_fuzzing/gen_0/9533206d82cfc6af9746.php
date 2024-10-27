<?php

$dom = new DOMDocument();
$dom->appendChild($dom->createElement('root'));

for ($i = PHP_INT_MAX; $i >= PHP_INT_MIN; $i--) {
    $node = $dom->createElement('node');
    $node->setAttribute('id', $i);
    $dom->appendChild($node);
}

$xml = simplexml_import_dom($dom);

?>
