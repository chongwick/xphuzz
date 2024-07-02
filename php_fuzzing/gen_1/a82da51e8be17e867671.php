<?php
for ($__v_1 = 0; $__v_1 < 5000; $__v_1++) {
    try {
        $array = array(); // Initialize an empty array
        array_reduce($array, function ($carry, $item) {
            $xml = new SimpleXMLElement('<xml/>');
            $xml->addAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
            $xml->addAttribute('xsi:schemaLocation', 'http://example.com/ schema.xsd');
            $xml->addAttribute('xsi:noNamespaceSchemaLocation', 'http://example.com/noNamespace.xsd');
            $xml->addAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
            $xml->addAttribute('xsi:schemaLocation', 'http://example.com/ schema.xsd');
            $xml->addAttribute('xsi:noNamespaceSchemaLocation', 'http://example.com/noNamespace.xsd');
            $xml->addAttribute('xsi:schemaLocation', 'http://example.com/ schema.xsd');
            $xml->addAttribute('xsi:noNamespaceSchemaLocation', 'http://example.com/noNamespace.xsd');
            $xml = xmlwriter_open_memory();
            xmlwriter_start_document($xml, '1.0', 'UTF-8');
            xmlwriter_end_document($xml);
            echo base64_encode($xml->outputMemory());
        });
    } catch (Exception $__v_2) {}
}

$__v_5 = new stdClass();
$__v_5->get = function () {
    // do nothing
};
