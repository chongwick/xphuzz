<?php
class Int8Array {
    public function __construct($size) {
        // no-op
    }
}

class TypedArray {
    public $saved;
    public $called;

    public function __construct($size) {
        $this->called = false;
        $this->saved = null;
    }

    public function __call($name, $args) {
        if ($name ==='map') {
            $this->called = true;
            $this->saved = $args[0];
        }
    }
}

$typedArray = new TypedArray(1);
$typedArray->map(array('test' => 'test'));
echo $typedArray->called. "\n"; // outputs 1
echo $typedArray->saved. "\n"; // outputs Array ( [test] => test )

deflate_init(2, array("a" => 0, "b" => 1, "c" => 3.0, "d" => 5473817451, "e" => 123475932, "f" => 2.23431234213480e-400));

?>
