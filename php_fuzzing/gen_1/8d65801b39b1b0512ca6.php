<?php
require "/home/w023dtc/template.inc";

$dom = new DOMDocument();
$bodyy = $dom->getElementsByTagName('body')->item(0);
if ($bodyy!== null) {
    try {
        $bodyy->parentNode->removeChild($bodyy);
    } catch (Exception $e) {
        echo $e->getMessage();
        $vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(13), 257), chr(0x80)^rand(0,2147483647), str_repeat(chr(161), 65537)^0x42);
    }
} else {
    echo "No body element found in the DOM.";
    $vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(13), 257), chr(0x80)^rand(0,2147483647), str_repeat(chr(161), 65537)^0x42);
}
?>
