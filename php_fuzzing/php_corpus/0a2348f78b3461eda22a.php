<?php
$v0 = array("foo1" => array("foo2" => array("foo3" => array("foo4" => array("foo5" => array("foo6" => array("foo7" => array())))))));
$v2 = get_class_vars(get_class(new stdClass()));
$v2['__proto__'] = $v0;
foreach($v2 as $v3 => $v4) {
    $$v4 = 'x1';
}
?>
