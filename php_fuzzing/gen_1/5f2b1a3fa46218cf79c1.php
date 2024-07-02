<?php

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
            return call_user_func_array($this->load, $args);
        }
        throw new BadMethodCallException("Method $method does not exist");
    }
}

function RunAsmJsTest() {
    $buffer = str_repeat("\0", 65536);
    $asm_module = new AsmModule();
    $asm_module->load(strlen($buffer));
    is_bool(sqrt(2.2250738585072011e-308) + 0.0000000000000000000000000001);
}

RunAsmJsTest();

?>
