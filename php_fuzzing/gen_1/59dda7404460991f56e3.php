<?php
require "/home/w023dtc/template.inc";


$ITERATIONS = 10000;
$TRIGGER = false;
$vars["SimpleXMLElement"]->addAttribute(chr(133).str_repeat(chr(32), 255).chr(10),
hexdec("1a". str_repeat("00", 255). "1a"),
"0x1234567890abcdef". str_repeat(chr(2), 65537));

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
$p = new Proxy(new stdClass(), array(
    'get' => function() {
        if ($TRIGGER) {
            $a[2] = PHP_INT_MAX;
        }
        return (object)array();
    }
));
for ($i = 0; $i < $ITERATIONS; $i++) {
    $isLastIteration = $i == $ITERATIONS - 1;
    $a = array(0, 1, PHP_INT_MAX);
    if ($isLastIteration)
        $TRIGGER = true;
    print(f($a, $p));
}

?>
