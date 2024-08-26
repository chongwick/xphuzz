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

function opt(&$ar) {
    array_unshift($ar, 2.3023e-320);
}

$ar = array();
for ($xo = 0; $xo < 20; $xo++) {
    opt($ar);
}

$r = new stdClass();
$o = Realm::global(PHP_INT_MAX);
$o->{'__p_'. getRandomProperty($o, PHP_INT_MIN)} = $o->{getRandomProperty($o, PHP_FLOAT_MAX)};
$o51 = array_merge($o, array_merge(array(1.1, 2.2, 3.3), array(false)));
sort($o51);

echo serialize($o);

?>
