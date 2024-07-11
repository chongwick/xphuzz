<?php

function assertThrows($code, $expectedException) {
    try {
        eval($code);
    } catch (ParseError $e) {
        return;
    }
    trigger_error('Custom error message', E_ERROR);
    throw new AssertionError('Expected a ParseError, but no exception was thrown');
}

$arrElement = str_repeat("-", 19). "U\x30". str_repeat("-", 7);
$str = '"'. "\x06length^\x00U\x02A\x01y$\x00\x01@\x03\x03". $arrElement. '$\x00'. chr($arrLen);
$oobArray = json_decode($e->data, true);
if (!isset($oobArray[0])) {
    return;
}
$oobObject = $oobArray[0];
$dv = $oobArray[1];
$ab = new \stdClass();
$ab->{"0"} = array();

assertThrows('x = 5;', 'ParseError');

?>
