<?php
<code>
<?php

class A {
}

$obj = new A;
unset($obj->name);
$class_num = $obj;
function foo() {
    $reflection = new \ReflectionFunction('foo');
    return $reflection;
}
date_default_timezone_set('America/New_York');
$date0 = strtotime('1995-12-17 03:24:00');
$dateFormat = date('F j, Y H:i:s', $date0);

foo();
foo();
foo();

echo $dateFormat;

?>
</code>

?>