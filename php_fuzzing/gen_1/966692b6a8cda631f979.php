<?php
require "/home/w023dtc/template.inc";


$ITERATIONS = 10000;
$TRIGGER = false;
$HEAP32 = array();
$asm_module;

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
    global $asm_module;
    $buffer = str_repeat("\0", 65536);
    $asm_module = new AsmModule();
    $asm_module->load(strlen($buffer));
}

class Proxy {
    private $subject;
    public function __construct($subject, $methods) {
        $this->subject = $subject;
        foreach ($methods as $method => $implementation) {
            if (!method_exists($this->subject, $method)) {
                $this->subject->$method = $implementation;
            }
        }
    }
    public function __call($method, $arguments) {
        return call_user_func_array(array($this->subject, $method), $arguments);
    }
}

$p = new Proxy(new stdClass(), array(
    'get' => function() {
        global $HEAP32;
        $HEAP32[PHP_INT_MAX] = 'test';
        return (object)array();
    }
));
for ($i = 0; $i < $ITERATIONS; $i++) {
    $isLastIteration = $i == $ITERATIONS - 1;
    $a = array();
    if ($isLastIteration)
        $TRIGGER = true;
    print(unserialize(base64_encode(serialize($asm_module))));
}

RunAsmJsTest();

?>
