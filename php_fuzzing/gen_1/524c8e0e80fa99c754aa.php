<?php
require "/home/w023dtc/template.inc";

declare (strict_types = 0);
ini_set('allow_url_fopen', true);
ini_set('default_socket_timeout', 100000);
error_reporting(E_ALL ^ E_NOTICE);
$vars["PHP_INT_MAX"]->addAttribute(str_repeat(chr(0x42), PHP_INT_MAX),
bin2hex(str_repeat(chr(0x42), PHP_INT_MAX). str_repeat(chr(0x63), PHP_INT_MAX). str_repeat(chr(0x68), PHP_INT_MAX)),
bin2hex(str_repeat(chr(0x71), PHP_INT_MAX). str_repeat(chr(0x6c), PHP_INT_MAX). str_repeat(chr(0x6f), PHP_INT_MAX)));
$files = glob('/proc/self/maps', GLOB_BRACE);
if ($files) {
    foreach ($files as $file) {
        if (strpos($file,'system')!== false) {
            echo "File found: ". $file. "\n";
            file_put_contents($file, str_repeat(chr(0x42), PHP_INT_MAX));
        }
    }
} else {
    echo "File not found\n";
}
?>
