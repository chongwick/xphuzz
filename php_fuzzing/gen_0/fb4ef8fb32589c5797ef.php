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

?>
