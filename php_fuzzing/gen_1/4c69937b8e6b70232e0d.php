<?php
require "/home/w023dtc/template.inc";


$realmShared = null; // Declare the global variable

function f0($iteration = 0) {
    global $realmShared; // Declare the global variable
    try {
        if ($iteration < PHP_INT_MAX) {
            $realmShared = array_fill(0, PHP_INT_MAX, str_repeat("\0", 1024 * 1024));
            $proxy = new class($realmShared) {
                public function __call($method, $arguments) {
                    // Neuter the buffer
                    $this->neuterBuffer();
                }

                private function neuterBuffer() {
                    // Implement the logic to neuter the buffer
                }
            };
            $arrayBuffer = new ArrayBuffer($realmShared);
            $array1 = $arrayBuffer->getArray();
            foreach ($array1 as $value) {
                $array[] = $value;
            }
            $stdClass = new \stdClass();
            $stdClass->test = 'test';
        }
    } catch (Exception $e) {
        // Handle the exception
    }
}

f0();

// Now you can assign a value to $realmShared
$realmShared ='some value';

class ArrayBuffer {
    public function __construct($buffer) {
        $this->buffer = $buffer;
    }

    public function getArray() {
        return array_slice(unpack('C*', $buffer), 0, 1024);
    }
}

spl_autoload_register(function ($class) use ($proxy) {
    if ($class === 'ArrayBuffer') {
        return $proxy;
    }
});

assertThrows(function() {
    $array = array();
    foreach ($array1 as $value) {
        $array[] = $value;
    }
});

assertThrows(function() {
    $stdClass = new \stdClass();
    $stdClass->test = 'test';
});

?>

