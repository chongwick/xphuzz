<?php

class __f_0 {
    public $x;

    public function __construct() {
        $this->x = 1;
    }
}

(new __f_0());
(new __f_0());

class __f_9 {
    public function __construct($ensure_fast_case = null) {
        $__f_12 = new class {
            public function __construct() {
                $this->initialized = true;
            }

            public function __set($name, $value) {
                $this->$name = $value;
                $this->$name = 23;
            }
        };
        $anon_obj = new $__f_12();
        new __f_0();
    }
}

(new __f_9());

$__v_15 = (object) array();
$__v_15->__set('', '');

?>
