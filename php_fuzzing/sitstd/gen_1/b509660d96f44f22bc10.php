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

    $a = array(); // Initialize $a as an array
    $b = array();

    $a['length'] = 4294967296; // 2 ^ 32 (max array length + 1)
    assertThrows(function() use ($a, $b) {
        array_join($b, array_values($a));
    }, 'TypeError: Array to string conversion');

    function assertThrows($callable, $expectedExceptionMessage) {
        try {
            $callable();
            throw new Exception("Expected $expectedExceptionMessage but no exception was thrown");
        } catch (Exception $e) {
            if (!strpos($e->getMessage(), $expectedExceptionMessage)) {
                throw new Exception("Expected $expectedExceptionMessage but got ". $e->getMessage());
            }
        }
    }

    function array_join($array, $glue) {
        $result = '';
        foreach ($array as $value) {
            $result.= $value. $glue;
        }
        return rtrim($result, ''); // Remove the last occurrence of any character
    }
}

RunAsmJsTest();

?>
