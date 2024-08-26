<?php
require "/home/w023dtc/template.inc";

$subject = PHP_INT_MAX. str_repeat(chr(0), 5). PHP_INT_MIN. PHP_FLOAT_MAX. PHP_FLOAT_MIN;
preg_match_all('/./u', $subject, $matches);
print_r($matches);
class WasmModuleBuilder {
    public $currentFunction;

    public function addGlobal($type, $value) {
        // implementation
    }

    public function addType($signature) {
        // implementation
    }

    public function addFunction($name, $signature) {
        $function = new stdClass();
        $function->name = $name;
        $function->signature = $signature;
        $function->locals = [];
        $function->body = [];
        $this->currentFunction = $function;
        return $function;
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

    public function addExternal($name, $type, $value) {
        // implementation
    }
}

?>
