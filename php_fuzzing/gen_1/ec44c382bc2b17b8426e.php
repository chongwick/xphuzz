<?php
require "/home/w023dtc/template.inc";


function getRandomProperty($v, $rand) {
    $properties = array_keys(get_object_vars($v));
    return $properties[$rand % count($properties)];
}

class Realm {
    public static function global($x) {
        $obj = new stdClass();
        $obj->test = 'test';
        return $obj;
    }
}

class Test {
    public $test = PHP_INT_MAX;
    public $test1 = PHP_INT_MIN;
    public $test2 = PHP_FLOAT_MAX;
    public $test3 = PHP_FLOAT_MIN;
    public $test4 = str_rot13(chr(0));
    public $test5 = str_rot13(chr(1)) ^ str_rot13(chr(-1)) ^ str_rot13(chr(2)) ^ str_rot13(chr(3)) ^ str_rot13(chr(4)) ^ str_rot13(chr(5)) ^ str_rot13(chr(10)) ^ str_rot13(chr(100)) ^ str_rot13(chr(100000)) ^ str_rot13(chr(5473817451)) ^ str_rot13(chr(123475932)) ^ str_rot13('2.23431234213480e-400');
}

$r = new stdClass();
$o = Realm::global(-10);
$o->{'__p_211203344'} = $o->{getRandomProperty($o, 211203344)};
$r->{$o->{'__p_211203344'}} = new Test();

?>
