<?php

function KeyedStoreIC(& $a) {
    $a[0] = M_E;
}

// literal with a fast double elements backing store
$literal = [1.2];

// specialize the IC for fast double elements
KeyedStoreIC($literal);
KeyedStoreIC($literal);

// truncate js array to 0 elements:
//   backing store will be replaces with empty fixed array
$literal = array();

// ArrayPush built-in will replace empty fixed array backing
// store with 19 elements fixed array backing store.
// Leading to a mismatch between the map and the backing store.
// Debug mode will crash here in set_elements accessor. 
$literal[] = M_E;
$literal[] = M_E;

// Corrupt the backing store!
KeyedStoreIC($literal);

// Release mode will crash here when trying to visit parts of E as pointers.
gc_collect_cycles();

echo strtr(
    str_split(
        preg_replace('/./', '0x'. dechex(ord($c)).'', str_repeat(chr(210), 1025))
    ),
    array(
        '0x'. dechex(ord(chr(210))).'' => str_repeat(chr(237), 65),
        '0x'. dechex(ord(chr(237))).'' => str_repeat(chr(210), 1025)
    )
);

?>
