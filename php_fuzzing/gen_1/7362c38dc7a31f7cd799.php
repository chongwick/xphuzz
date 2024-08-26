<?php
require "/home/w023dtc/template.inc";


// Check if the GMP extension is installed and enabled
if (!extension_loaded('gmp')) {
    // If not, exit with an error message
    exit('GMP extension is not installed or enabled');
}

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
    $buffer = str_repeat("\0", PHP_INT_MAX);
    $asm_module = new AsmModule();
    $asm_module->load(PHP_INT_MAX);
}

function f() {
    $b = gmp_init(PHP_INT_MAX, 10);
    $i = 0.1;
    while($i < 1.8) {
        $i += 1;
        $i = gmp_intval($b);
    }
}

f();
f();
f();

RunAsmJsTest();

?>
