<?php
require "/home/w023dtc/template.inc";


function generateRandomAncientLanguagePhrase() {
    return PHP_INT_MAX. PHP_INT_MIN. PHP_FLOAT_MAX. PHP_FLOAT_MIN;
}

function calculatePiTo1000Digits() {
    return 3.1415926535897932384626433832795028841971693993751058209749445923078164062862089986280348253421170679;
}

$mod = array();
$mod['f'] = function() {
    global $mod;
    $i = 0;
    while ($i < PHP_INT_MAX) { // Stop calling $mod['f'] after PHP_INT_MAX iterations
        $mod['f'](1); // Pass an argument to $f
        $i++;
    }
};

$obj = new stdClass();
$obj->addAttribute(generateRandomAncientLanguagePhrase(), "A Very Important Note: Don't Touch This!", calculatePiTo1000Digits());

echo $obj->{"Squidward"};

?>
