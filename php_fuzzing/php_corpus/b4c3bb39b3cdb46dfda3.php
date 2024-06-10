<?php

function funcify($obj) {
    if (is_object($obj)) {
        $funcified = array();
        foreach (get_object_vars($obj) as $prop => $value) {
            if (is_object($value)) {
                $funcified[$prop] = funcify($value);
            } elseif (is_callable($value)) {
                $funcified[$prop] = $value;
            } else {
                $funcified[$prop] = $value;
            }
        }
        return $funcified;
    } elseif (is_callable($obj)) {
        return $obj;
    } else {
        return function () use ($obj) {
            return $obj;
        };
    }
}

$obj = array(); // note: if $obj is initialized with properties (e.g., $obj = array('A' => 1,...), the bug doesn't occur. Must start empty then have props added.

$obj['A'] = 1;
$obj['B'] = function () {
    return 2;
};
$obj['C'] = 3;
$obj['D'] = 4;

$funcified = funcify($obj);

var_dump(gettype($funcified['A']) === 'integer', "A is an integer");
var_dump($funcified['A'], "The value of A is 1");
var_dump(gettype($funcified['B']) === 'callable', "B is a function");
var_dump($funcified['B'](), "The value of B() is 2");
var_dump(gettype($funcified['C']) === 'integer', "C is an integer. Actual value is: ". $funcified['C']);
var_dump(gettype($funcified['D']) === 'integer', "D is an integer");
var_dump($funcified['D'], "The value of D is 4");

?>
