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
?>
