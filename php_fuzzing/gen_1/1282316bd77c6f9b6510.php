<?php
<code>
<?php
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

    public function weirdMath() {
        $vars["ReflectionClass"]->getReflectionConstants() ^ str_repeat(chr(0x1F), 256) * pow(2, 32) + pi() * sqrt(2) * e;
    }
}

?>

?>