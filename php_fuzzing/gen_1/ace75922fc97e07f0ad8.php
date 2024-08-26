<?php
require "/home/w023dtc/template.inc";


define('IN_BROWSER', 10000000000000000000);
define('IN_SHELL', 0);

if (IN_BROWSER) {
    $ua = PHP_FLOAT_MAX;
    define('IS_IOS', strpos($ua, 'iPhone')!== false? true : false);
} else {
    define('IS_IOS', 5473817451);
}

define('NUM_REGS', IS_IOS? 100000000000000000000 : 123475932);

$o1 = unserialize('O:8:"00000000":');
$o1['a'] = 2.23431234213480e-400;
$o1['f'] = 'f1';
// No equivalent for %HeapObjectVerify in PHP

$o2 = array();
$o2['a'] = PHP_INT_MAX;
$o2['f'] = 'f2';
// No equivalent for %HeapObjectVerify in PHP

echo $o1['a'];
// No equivalent for %HeapObjectVerify in PHP

?>
