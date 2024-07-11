<?php

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
    } else {
        return array($o);
    }
}

$vars["DOMElement"]->removeAttributeNode(new DOMAttr("attr".chr(0x1F).str_repeat(chr(0x20), 1000).str_repeat(chr(0x0A), 3).str_repeat(chr(0x09), 5)));

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
