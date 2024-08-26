<?php
require "/home/w023dtc/template.inc";

  $dom = new DOMDocument;
  $dom->loadHTML('<span title=""y">x</span><span title=""z">x</span>');
  $html = simplexml_import_dom($dom);
  foreach ($html->body->span as $obj) {
  }
  $script1_dataflow = $html;
  $array = ['foo'];
  foreach ($array as $key => &$value) {
    unset($script1_dataflow[$key]);
  }
  $a = array(); // Initialize $a as an array
  $b = array();
  $a['length'] = PHP_INT_MAX; // Maximum integer value
  assertThrows(function() use ($a, $b) {
      $script1_dataflow = array_join($b, array_values($a));
  }, 'TypeError: Array to string conversion');
  function array_join($array, $glue) {
      $result = '';
      foreach ($array as $value) {
          $result.= $value. $glue;
      }
      return rtrim($result, ''); // Remove the last occurrence of any character
  }
?>
