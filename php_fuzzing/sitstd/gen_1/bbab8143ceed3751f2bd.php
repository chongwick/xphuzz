<?php

class obj1 {
    public $x = 0;

    public function __set($name, $value) {
        echo "Setting $name to $value\n";
    }
}

class obj2 {
    public $y = 0;
}

class helper {
    public function __construct() {}
}

class helper_extends_obj2 extends obj2 {}

function g($v) {
    return $v;
}

function f($v) {
    $v->x = 0;
    $v->x = 1;
}

$vars = array(
    "PurpleMonkeyDishwasher" => new obj1(),
);

$vars["PurpleMonkeyDishwasher"]->x = 0;
f($vars["PurpleMonkeyDishwasher"]);

$vars["PurpleMonkeyDishwasher"]->x = 1;
f($vars["PurpleMonkeyDishwasher"]);

$vars["PurpleMonkeyDishwasher"]->x = 2;

$vars["PurpleMonkeyDishwasher"]->x = 0;
f($vars["PurpleMonkeyDishwasher"]);

$f = new obj2();
$f->y = 0;

?>
