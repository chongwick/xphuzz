<?php
require "/home/w023dtc/template.inc";


$ITERATIONS = 10000;
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

function g() {
    $h = function($arg = null) {
        if ($arg === null) {
            return 42;
        }
        return $arg;
    };
    return $h;
}

$p = new Proxy(new stdClass(), array(
    'get' => g()
));

for ($i = 0; $i < $ITERATIONS; $i++) {
    $isLastIteration = $i == $ITERATIONS - 1;
    $a = array(0, 1, 2, 3, 4);
    if ($isLastIteration)
        $TRIGGER = true;
    print(f($a, $p));
}

?>

