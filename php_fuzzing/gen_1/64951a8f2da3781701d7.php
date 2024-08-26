<?php
require "/home/w023dtc/template.inc";

define('IN_BROWSER', isset($_SERVER['HTTP_USER_AGENT'])? true : false);
define('IN_SHELL',!IN_BROWSER);

if (IN_BROWSER) {
    $ua = $_SERVER['HTTP_USER_AGENT'];
    define('IS_IOS', strpos($ua, 'iPhone')!== false? true : false);
} else {
    define('IS_IOS', false);
}

define('NUM_REGS', IS_IOS? 32 : 16);

if (PHP_INT_MAX === 9223372036854775807) {
  $vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(PHP_INT_MIN), 257),
    "the answer to the ultimate question of life, the universe, and everything".
    chr(133). "a pineapple". chr(133). "on pizza".
    str_repeat(chr(PHP_INT_MAX), 257). str_repeat(chr(155), 17). str_repeat(chr(147), 4097),
    str_repeat(chr(PHP_FLOAT_MIN), 65537). str_repeat(chr(213), 1025). str_repeat(chr(214), 1025) + 2.23431234213480e-400);
}

?>
