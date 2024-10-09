<?php

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

$r = new stdClass();
$o = Realm::global(-10);
$o->{'__p_211203344'} = $o->{getRandomProperty($o, 211203344)};

$var1 = "A". str_repeat("A", 0x100);
$var2 = str_repeat("A", 0x100). "A";
mb_scrub($o->{getRandomProperty($o, 211203344)}. " ". $var2, "A". str_repeat("A", 0x100). " ". str_repeat("A", 0x100));

?>
