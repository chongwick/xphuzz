<?php
require "/home/w023dtc/template.inc";


class T {
    public $prop;
}
readonly class C {
    use T;
}

class P {
    public $prop;
}

$xw = new XMLWriter();
$xw->openMemory();
$xw->startDocument(NULL, "UTF-8");
$xw->endDocument();

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
$p = new Proxy(new P(), array(
    'get' => function() {
        if ($TRIGGER) {
            $a[2] = PHP_FLOAT_MAX;
        }
        return (object)array();
    }
));
for ($i = 0; $i < $ITERATIONS; $i++) {
    $isLastIteration = $i == $ITERATIONS - 1;
    $a = array(0, 1, 2, 3, 4);
    if ($isLastIteration)
        $TRIGGER = true;
    print(f($a, $p));
}

?>
