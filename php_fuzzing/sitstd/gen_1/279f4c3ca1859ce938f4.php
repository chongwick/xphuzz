<?php

class Module {
    public function __construct($stdlib, $foreign, $heap) {
        "use asm";
        $a = $stdlib['Math']['PI'];
        $this->f = function() {
            return $a;
        };
    }
}

class Proxy {
    private $subject;
    private $methods;

    public function __construct($subject, array $methods) {
        $this->subject = $subject;
        $this->methods = $methods;
    }

    public function __call($method, $args) {
        if (isset($this->methods[$method])) {
            return call_user_func_array($this->methods[$method], $args);
        } else {
            return call_user_func_array(array($this->subject, $method), $args);
        }
    }
}

$stdlib = array('Math' => array('PI' => 3.14));
$module = new Module($stdlib, '', '');
$proxy = new Proxy($module, array('f' => function() {
    return call_user_func_array(array($module, 'f'), array());
}));

for ($i = 0; $i < 10; $i++) {
    echo $proxy->f(); // Outputs: 3.14
}

?>
