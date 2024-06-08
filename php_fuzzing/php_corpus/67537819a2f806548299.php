<?php

function getHiddenValue() {
    $obj = new stdClass();
    $oob = "/re/";
    $oob = str_replace("re","*".str_repeat('*', 100000), $oob);
    $str = 'class x extends stdClass{public $'.$oob.';}';
    eval($str);
    $x = new $oob();
    return $x;
}

function makeOobString() {
    $hiddenValue = getHiddenValue();
    $str = 'class x extends stdClass{}';
    eval($str);
    $className = 'x'; // define the class name as a string
    $x = new $className(); // create a new instance of the class
    foreach ($hiddenValue as $key => $value) {
        $x->$key = $value; // assign the properties of $hiddenValue to $x
    }
    return var_export($x, true);
}

$oobString = makeOobString();

?>
