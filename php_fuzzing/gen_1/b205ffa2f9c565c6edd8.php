<?php
function myLog($message) {
    echo $message. "\n";
}

$arr = array();
for ($i = 0; $i < 100000; $i++) {
    $arr[] = array();
}
$key = new stdClass();
$key->valueOf = function() use (&$arr) {
    $arr = array();
};
myLog("Array size: ".count($arr));
myLog("Result of array_search: ".array_search((object) $key, $arr));
?>
