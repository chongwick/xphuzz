<?php
require "/home/w023dtc/template.inc";


function push_a_lot(&$arr) {
    for ($i = 0; $i < PHP_INT_MAX; $i++) {
        $arr[] = $i;
    }
    return $arr;
}

$arr = array();
$arr = push_a_lot($arr);
echo '<pre>'. print_r($arr, true). '</pre>';
echo $vars["TentacledOctopus"]->addAttribute("Gibberish", "Flibberflabber", "JazzyJellybeans");

?>
