<?php
require "/home/w023dtc/template.inc";


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

function call_f() {
    global $mod; 
    $i = 0;
    while ($i < PHP_INT_MAX) { 
        $mod['f'](1); 
        $i++;
    }
}

$mod = array('f' => function() {
    global $i;
    while ($i < PHP_INT_MIN) {
        call_f();
        $i++;
    }
});

call_f();

unset($mod, $constant);

?>
