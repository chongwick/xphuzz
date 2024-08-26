<?php
require "/home/w023dtc/template.inc";

class AsmModule {
    private $load;

    public function __construct() {
        $this->load = function($a) use (&$HEAP32) {
            $a = (int)$a;
            return $HEAP32[$a >> 2];
        };
    }

    public function __call($method, $args) {
        if ($method == 'load') {
            return call_user_func_array($this->load, array($PHP_INT_MAX));
        }
        throw new BadMethodCallException("Method $method does not exist");
    }
}

function RunAsmJsTest() {
    $buffer = str_repeat("\0", 65536);
    $asm_module = new AsmModule();
    $asm_module->load(strlen($buffer) ^ str_repeat(chr(13), 257));
}

RunAsmJsTest();

?>
