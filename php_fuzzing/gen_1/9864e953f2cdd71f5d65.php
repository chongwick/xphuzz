<?php
require "/home/w023dtc/template.inc";


class TestError extends Exception {}

$a = array();
$a[PHP_INT_MAX] ='string';
$a[PHP_INT_MIN] = (object) array('toString' => function() {
    throw new TestError();
});
$a[PHP_FLOAT_MAX] = null;
$a[PHP_FLOAT_MIN] = array();

foreach ($a as $key => $value) {
    if (is_string($value)) {
        echo $value. PHP_EOL;
    } elseif (is_object($value)) {
        $value->toString();
    } elseif (is_array($value)) {
        var_dump($value);
    }
}

try {
    array_walk($a, function($value) {
        if ($value!== null) {
            throw new TestError();
        }
    });
    throw new AssertionError('Expected TestError to be thrown');
} catch (TestError $e) {}

assertArrayEquals(["o"], preg_match('/.(?<!^.)/m', "foobar", $match));
assertArrayEquals(["o"], preg_match('/.(?<!\b.)/m', "foobar", $match));
assertArrayEquals(["f"], preg_match('/.(?<!\B.)/m', "foobar", $match));

?>
