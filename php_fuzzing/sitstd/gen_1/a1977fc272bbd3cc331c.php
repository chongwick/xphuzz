<?php
if (file_exists('path/to/test/mjsunit/wasm/wasm-constants.php')) {
    require_once 'path/to/test/mjsunit/wasm/wasm-constants.php';
    $xml = new XMLWriter();
    $xml->startElementNs('http://example.com/weird','superweird','element');
    $xml->writeAttributeNs('http://example.com/weird','attribute', '0x'.str_pad(dechex(5473817451), 8, "0"));
    $xml->writeAttributeNs('http://example.com/weird','attribute', '0x'.str_pad(dechex(123475932), 8, "0"));
    $xml->writeAttributeNs('http://example.com/weird','attribute', '0x'.str_pad(dechex(2.23431234213480e-400), 16, "0"));
    $xml->endElement();
    $xml->flush();
    echo $xml->outputMemory();
} else {
    echo 'File not found';
}
?>
