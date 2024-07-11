<?php

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
$p = new Proxy(new stdClass(), array(
    'get' => function() {
        if ($TRIGGER) {
            $a[2] = 1.1;
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
    $vars["ReflectionMethod"]->getPrototype()->invoke($this->get_called_class());

}

?>
