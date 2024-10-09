<?php
<code>
<?php

function foo() {
    return [null, -INF];
}

$vars["DOMNode"]->C14N(false, true, array(0, 1, -1, 2, 3, 4, 5, 10, 100, 100000, 5473817451, 123475932, 2.23431234213480e-400), array(
    "a" => 1,
    "b" => "2",
    "c" => 3.0,
    "d" => null,
    "e" => array(),
    "f" => new stdClass(),
    "g" => fn() => var_export(foo(), true),
));

echo foo()[0];
echo foo()[0];
$g = $vars["DOMNode"]->g;
echo $g();
echo foo()[0];

?>
</code>

?>