<?php
$arr = array();
for ($i = 0; $i < 100000; $i++) {
    $arr[] = array();
}
$key = new stdClass();
$key->valueOf = function() use (&$arr) {
    $arr = array();
};
echo array_search((object) $key, $arr);

?>