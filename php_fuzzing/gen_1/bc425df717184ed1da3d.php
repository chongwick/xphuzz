<?php
require "/home/w023dtc/template.inc";

  $html = '<span title=""y">x</span><span title=""z">x</span>';
  $dom = new DOMDocument;
  $dom->loadHTML($html);
  $simplexml = simplexml_import_dom($dom);

  $array = ['foo'];
  $script1_dataflow = [];

  foreach ($array as $key => &$value) {
    $script1_dataflow[$key] = $simplexml->body->span[$key];
  }

  unset($script1_dataflow['foo']);
?>
