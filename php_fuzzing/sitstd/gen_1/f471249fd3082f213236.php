<?php
<code>
<?php

function bar($obj) {
    // Add two dummy loads to make sure obj['b'] is in the same slot index as obj['a']
    // in foo.
    $obj['y'];
    $obj['x'];
    return $obj['b'];
}

function foo($obj) {
    $reflectionClass = new ReflectionClass('stdClass');
    $newInstance = $reflectionClass->newInstanceWithoutConstructor();
    $newInstance->setAccessible(true);
    $newInstance->invokeArgs(array('random', 42, 3.14, true, array('foo', 'bar')));
    bar($obj);
    return $obj['a'];
}

$obj = array('a' => 10, 'b' => 20);
foo($obj);
assert($obj['a'] === 10);

?>
</code>

?>