<?php
require "/home/w023dtc/template.inc";


$vars["SimpleXMLElement"]->addAttribute(
    str_repeat(chr(0), PHP_INT_MAX).
    bin2hex(str_repeat(chr(0), PHP_INT_MAX). str_repeat(chr(0), 17). str_repeat(chr(0), 4097)).
   'Hello, World! '.
    str_repeat(chr(0), 65537). str_repeat(chr(0), 1025). str_repeat(chr(0), 1025)).
    '(123475932 * 2.23431234213480e-400) + 5473817451 = 0.5';

// Create a buffer
$buffer = str_repeat("\0", PHP_INT_MAX);

// Create a proxy for the buffer constructor
$proxy = new class($buffer) {
    public function __call($method, $arguments) {
        // Neuter the buffer
        $this->neuterBuffer();
    }

    private function neuterBuffer() {
        // Implement the logic to neuter the buffer
    }
};

// Set the buffer constructor
class ArrayBuffer {
    public function __construct($buffer) {
        $this->buffer = $buffer;
    }

    public function getArray() {
        return array_slice(unpack('C*', $buffer), 0, PHP_INT_MAX);
    }
}

// Set the proxy as the constructor for ArrayBuffer
spl_autoload_register(function ($class) use ($proxy) {
    if ($class === 'ArrayBuffer') {
        return $proxy;
    }
});

// Create an array-like object
$arrayBuffer = new ArrayBuffer($buffer);
$array1 = $arrayBuffer->getArray();

// Test the assertion
function assertThrows($callback) {
    try {
        $callback();
        echo "Test failed";
    } catch (Exception $e) {
        echo "Test passed";
    }
}

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
