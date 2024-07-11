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

function main() {
    function v1($v2, $v3, $v4, $v5) {
        $typedArray = new TypedArray(1);
        $func = $v4;
        $typedArray->$func($v2, $v3, $v5);
    }
    function v4($v1, $v2, $v3) {
        $typedArray = new TypedArray(1);
        $typedArray->map(array('test' => 'test'));
    }
    v1('v2', 'v3', 'v4', 'v5');
}

main();

?>
