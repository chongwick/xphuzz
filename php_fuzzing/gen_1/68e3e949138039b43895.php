<?php
require "/home/w023dtc/template.inc";


function spread($o) {
    if ($o instanceof stdClass) {
        $new = new stdClass();
        foreach ($o as $key => $value) {
            $new->$key = $value;
        }
        return $new;
    } elseif (is_array($o)) {
        return $o;
    } elseif ($o === null) {
        return array();
    } elseif ($o === PHP_INT_MAX) {
        $o = array($o);
    } elseif ($o === PHP_INT_MIN) {
        $o = array($o);
    } elseif ($o === PHP_FLOAT_MAX) {
        $o = array($o);
    } elseif ($o === PHP_FLOAT_MIN) {
        $o = array($o);
    } else {
        return array($o);
    }
}

// Transition to MEGAMORPHIC
var_dump(spread(new stdClass)); // equivalent to new function C1() {}
var_dump(spread(new stdClass)); // equivalent to new function C2() {}
var_dump(spread(new stdClass)); // equivalent to new function C3() {}
var_dump(spread(new stdClass)); // equivalent to new function C4() {}
var_dump(spread(new stdClass)); // equivalent to new function C5() {}

// Trigger Runtime_ObjectCloneIC_Slow() with a non-JSReceiver.
var_dump(spread(null)); // equivalent to spread(undefined)
var_dump(spread(array())); // equivalent to spread({})

?>
