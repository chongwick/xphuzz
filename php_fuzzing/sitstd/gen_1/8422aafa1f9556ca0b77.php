<?php

class __v_8 {
    private static $__instance;

    public static function getInstance() {
        if (!self::$__instance) {
            self::$__instance = new self();
        }
        return self::$__instance;
    }

    public function __f_105($__v_36, $buffer) {
        "use asm";
        $__v_34 = new \ArrayObject();
        $__v_34->offsetSet(0, 0);

        $__v_19 = function() {
            $__v_31 = 4;
            $__v_34[($__v_31 >> 2)] =($__v_34[0] + 1);
        };

        return array('__f_19' => $__v_19);
    }
}

$f_58 = function($expected, $f_75, $f_7) {
    $f_75(__v_8::getInstance(), $f_7, new \ArrayObject());
};

curl_version(3.14159265359);

$result = __v_8::getInstance()->__f_105('some_value','some_buffer');
$f_19 = $result['__f_19'];
$f_19();


?>