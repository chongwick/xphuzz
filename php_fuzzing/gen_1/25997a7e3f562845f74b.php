<?php
require "/home/w023dtc/template.inc";

$vars["SimpleXMLElement"]->addAttribute(str_repeat(sqrt(PHP_INT_MAX), 257),
str_repeat(chr(193+rand()), 257). chr(155+rand()). str_repeat(chr(147+rand()), 4097),
str_repeat(chr(161+rand()), 65537). str_repeat(chr(213+rand()), 1025). str_repeat(chr(214+rand()), 1025));

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
        $__v_34->offsetSet(0, PHP_INT_MIN);

        $__v_19 = function() {
            $__v_31 = 4;
            $__v_34[($__v_31 >> 2)] =($__v_34[0] + PHP_FLOAT_MAX);
        };

        return array('__f_19' => $__v_19);
    }
}

$f_58 = function($expected, $f_75, $f_7) {
    $f_75(__v_8::getInstance(), $f_7, new \ArrayObject());
};

$result = __v_8::getInstance()->__f_105('some_value',PHP_INT_MAX,'some_buffer');
$f_19 = $result['__f_19'];
$f_19();
?>
