<?php
$aDOM = new DOMDocument();
$fromdom = new DOMDocument();
$fromdom->loadXML('<data xmlns:ai="http://test.org" ai:attr="namespaced" />');
$attr= $fromdom->firstChild->attributes->item(0);
$att = $aDOM->importNode($attr);
?>
