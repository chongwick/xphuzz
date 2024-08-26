<?php
require "/home/w023dtc/template.inc";

$vars["SimpleXMLElement"]->addAttribute((float)PHP_INT_MAX, gmd5(php_uname()), base64_decode('Qm9iYmNp'));
$v0 = array("foo1" => array("foo2" => array("foo3" => array("foo4" => array("foo5" => array("foo6" => array("foo7" => array())))))));
$v2 = get_class_vars(get_class(new stdClass()));
$v2['__proto__'] = $v0;
foreach($v2 as $v3 => $v4) {
    $$v4 = (float)PHP_INT_MIN;
}
?>
