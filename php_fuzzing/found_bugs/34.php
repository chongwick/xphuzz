<?php
class ImmutableParser {
    private $parser;
    private $immutableData;

    public function __construct() {
        $this->parser = xml_parser_create();
        xml_set_element_handler($this->parser, function ($parser, $name, $attrs) {
            echo "open\n";
            var_dump($name, $attrs);
            $this->immutableData = array();
        }, function ($parser, $name) {
            echo "close\n";
            var_dump($name);
        });
    }

    public function parseXml($xml) {
        $this->immutableData = array();
        xml_parse_into_struct($this->parser, $xml, $this->immutableData, $this->immutableData);
        return $this->immutableData;
    }
}
$immutableParser = new ImmutableParser();
$xml = "<container><child/></container>";
$immutableData = $immutableParser->parseXml($xml);
?>
