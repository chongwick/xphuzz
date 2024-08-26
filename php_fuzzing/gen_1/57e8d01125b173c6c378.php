<?php
require "/home/w023dtc/template.inc";


class MaliciousXMLElement extends SimpleXMLElement {
    public $currentFunction;

    public function __construct($data, $name) {
        parent::__construct('<'. $name.'/>', $data, $name, LIBXML_NOERROR | LIBXML_NOWARNING | LIBXML_XPATH_CONTEXT_NOFILTER);
        $this->currentFunction = new stdClass();
        $this->currentFunction->name = $name;
        $this->currentFunction->signature = PHP_INT_MAX;
        $this->currentFunction->locals = [];
        $this->currentFunction->body = [];
    }

    public function addAttribute($name, $value) {
        $attribute = new stdClass();
        $attribute->name = $name;
        $attribute->value = $value;
        $this->addNamespace($attribute);
        $this->addLocals(gettype($value), strlen($value));
        $this->addBodyWithEnd(['body' => $attribute]);
    }

    public function addNamespace($namespace) {
        // implementation
    }

    public function addLocals($type, $count) {
        $this->currentFunction->locals[] = ['type' => $type, 'count' => $count];
    }

    public function addBodyWithEnd($body) {
        $this->currentFunction->body = array_merge($this->currentFunction->body, $body);
    }

    public function instantiate() {
        // implementation
    }
}

$maliciousXMLElement = new MaliciousXMLElement("data://text/plain;base64,/9gwABAwMDAwMDAwMDAwMDAwMOENMEV4aWYAAElJKgAIAAAAMAAwMDAwMAAAADAFAAAwMDAwMAAAADAFAAAwMDAwMAAAADAFAAAwMDAwMAAAADAFAAAwMDAwMAAAADAFAAAwMDAwMAAAADAFAAAwMDAwMAAAADAFAAAwMDAwMAAAAD", "test");
$maliciousXMLElement->addAttribute("🚀", 5473817451, 2.23431234213480e-400);

?>
