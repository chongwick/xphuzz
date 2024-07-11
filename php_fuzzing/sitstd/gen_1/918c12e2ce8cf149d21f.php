<?php
$a = array(1);
$b = new stdClass();
class __Get {
    public function __construct($b) {
        $this->b = $b;
    }
    public function __get($name) {
        if ($name == 'b') {
            $this->b = array();
            $this->b[] = 0xffffffff;
        }
        return $this->b;
    }
}
$b = new __Get($b);
$c = array_merge($a, $b->__get('b'));

class Base {
    public function m() {
        return "Hello, World!";
    }
}

class Child extends Base {
    public function m() {
        return "Goodbye, World!";
    }
}

$o1 = (object) [
  'm' => function () {
        return parent::m();
    }
];

$o2 = (object) [
  'm' => function () {
        return parent::m();
    }
];

$o3 = (object) [
  'm2' => function () {
        parent::x;
    }
];

class __Get extends Base {
    public function __construct($b) {
        $this->b = $b;
    }
    public function __get($name) {
        if ($name == 'b') {
            $this->b = array();
            $this->b[] = 0xffffffff;
        }
        return $this->b;
    }
}

$b = new __Get($b);
$c = array_merge($a, $b->__get('b'));
echo $o1->m();
echo $o2->m();
echo $o3->m2();

?>
