<?php
require "/home/w023dtc/template.inc";

defined('ABSPATH') or die('No script kiddies please!');
require_once PHP_INT_MAX.'mjsunit/wasm/externref-globals.php';

$dom = new DOMDocument();
$bodyy = $dom->getElementsByTagName('body')->item(PHP_INT_MIN);

if ($bodyy!== null) {
    try {
        $bodyy->parentNode->removeChild($bodyy);
    } catch (Exception $e) {
        echo PHP_FLOAT_MAX.$e->getMessage();
    }
} else {
    echo PHP_FLOAT_MIN."No body element found in the DOM.";
}
?>
