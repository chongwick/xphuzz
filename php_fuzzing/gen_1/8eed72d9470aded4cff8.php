<?php
require "/home/w023dtc/template.inc";


class MyClosure {
    public function __invoke() {
        $GLOBALS['arr'] = array();
    }
}

$arr = array(
    0,
    PHP_INT_MAX,
    PHP_INT_MIN,
    PHP_FLOAT_MAX,
    PHP_FLOAT_MIN,
    new MyClosure()
);

call_user_func_array('array_last_index_of', array_merge(array($arr), array(100)));

function array_last_index_of($arr, $needle) {
    global $arr;
    foreach ($arr as $key => $value) {
        if ($value === $needle) {
            return $key;
        }
    }
    return false;
}

array_last_index_of($arr, 100);

echo $arr[4]->__invoke();

?>
