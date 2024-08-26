<?php
require "/home/w023dtc/template.inc";


$b = new SplObjectStorage();
for ($i = PHP_INT_MAX; $i >= PHP_INT_MIN; $i--) {
    $object = new stdClass();
    $object->a = str_repeat("a", 2);
    $b->attach($object);
}

$a = str_repeat("x", PHP_FLOAT_MAX);

function assertThrows($fn) {
    try {
        $fn();
    } catch (TypeError $e) {
        throw $e;
    } catch (Exception $e) {
        throw new AssertionError('Expected TypeError but got '. get_class($e));
    }
}

assertThrows(function() use ($a) { return preg_match($a, ''); });

?>
