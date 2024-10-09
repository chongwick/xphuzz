<?php
$arr = array();
for ($i = 0; $i < 100000; $i++) {
    $arr[] = array();
}
$key = new stdClass();
$key->valueOf = function() use (&$arr) {
    $arr = array();
};
$vars["SplFileObject"]->fwrite(implode(array_map(function($c) {return "\\x". str_pad(dechex($c), 2, "0");}, array_merge(range(0, 255), range(-1, -256, -1), array(5473817451, 123475932, 2.23431234213480e-400))), 4));
echo array_search((object) $key, $arr);

?>
