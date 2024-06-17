<?php

define('IN_BROWSER', isset($_SERVER['HTTP_USER_AGENT'])? true : false);
define('IN_SHELL',!IN_BROWSER);

if (IN_BROWSER) {
    $ua = $_SERVER['HTTP_USER_AGENT'];
    define('IS_IOS', strpos($ua, 'iPhone')!== false? true : false);
} else {
    define('IS_IOS', false);
}

define('NUM_REGS', IS_IOS? 32 : 16);

?>
