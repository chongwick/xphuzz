<?php

class BigInt64Array {
  private $buffer;

  public function __construct($size) {
    $this->buffer = str_repeat("\0", $size * 8);
  }

  public function getBuffer() {
    return $this->buffer;
  }

  public static function of($array, $evil_object) {
    return call_user_func_array(array($evil_object, '__toString'), array($array->getBuffer()));
  }
}

class EvilObject {
  public function __toString() {
    // equivalent of %ArrayBufferNeuter(array.buffer);
    $buffer = str_split(unpack('H*', $GLOBALS['array']->getBuffer())[1], 1);
    array_walk($buffer, function(&$v) { $v = 0; });
    gc_collect_cycles();
    return 71748523475265 - 16; // rax: 0x41414141414141
  }
}

$evil_object = new EvilObject();

$GLOBALS['array'] = new BigInt64Array(11);

$GLOBALS['root'] = BigInt64Array::of($GLOBALS['array'], $evil_object);

gc_collect_cycles(); // trigger

// Create a buffer
$buffer = str_repeat("\0", 1024 * 1024);

// Create a proxy for the buffer constructor
$proxy = new class($buffer) {
    public function __call($method, $arguments) {
        // Neuter the buffer
        $this->neuterBuffer();
    }

    private function neuterBuffer() {
        // Implement the logic to neuter the buffer
        $this->buffer = str_split(unpack('H*', $GLOBALS['array']->getBuffer())[1], 1);
        array_walk($this->buffer, function(&$v) { $v = 0; });
        gc_collect_cycles();
    }
};

// Set the buffer constructor
class ArrayBuffer {
    public function __construct($buffer) {
        $this->buffer = $buffer;
    }

    public function getArray() {
        return array_slice(unpack('C*', $buffer), 0, 1024);
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
