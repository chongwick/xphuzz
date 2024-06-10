<?php

$a = array('y' => 1.5);
$a['y'] = 1093445778;
$b = $a['y'];
$c = array('y' => array());

function f() {
    global $b;
    return array('y' => $b);
}

f();
f();
f();
echo var_dump(f()) == array('y' => 1093445778); // assertEquals(f().y, 1093445778);

?>
