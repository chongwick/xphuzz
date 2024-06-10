<?php
function getHiddenValue() {
    $oob = "/re/";
    $oob = str_replace("re", str_repeat("*", 0x100000), $oob);
    $str = 'class x extends stdClass{var $hidden = "'. $oob. '";}';
    eval($str);
    return $x->hidden;
}

function makeOobString() {
    $hiddenValue = getHiddenValue();
    $str = 'class x extends stdClass{}';
    eval($str);
    $x = new $str;
    $x->hidden = $hiddenValue;
    return $x;
}

$oobString = makeOobString()->hidden;

?>
