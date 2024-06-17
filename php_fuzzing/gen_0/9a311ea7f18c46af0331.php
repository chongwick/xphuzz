<?php

class HeapObjectVerify {
    public static function verify($object) {
        // todo: implement heap object verification
    }
}

$constant = array('a' => 1);

function update_array(array $array) {
    $array['x'] = $constant;
    HeapObjectVerify::verify($array);
    $array[0] = null;
    HeapObjectVerify::verify($array);
    return $array;
}

$ar1 = array(1);
$ar2 = array(2);
$ar3 = array(3);

update_array($ar1);
$constant = update_array($ar2);
update_array($ar3);

// You can manually free memory using unset() function
unset($ar1, $ar2, $ar3, $constant);

?>
