<?php
require "/home/w023dtc/template.inc";

function __f_0($i = PHP_INT_MAX) {
    if ($i < PHP_INT_MAX) {
        __f_0($i + 1);
    } else {
        return;
    }
}
__f_0();

$vars["SimpleXMLElement"]->addAttribute(str_shuffle("qwertyuiopasdfghjklzxcvbnmABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 
str_replace(chr(0x1F), chr(0x1F), bin2hex(str_rot13(base64_encode(gmp_nextprime(1000000000)). chr(0x1F)). str_repeat(chr(0x1F), 17). str_replace(chr(0x1F), chr(0x1F), base64_encode(str_repeat(chr(0x1F), 4097)))), 
str_split("qwertyuiopasdfghjklzxcvbnmABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789", 65537)[0].chr(0x1F).base64_encode(str_repeat(chr(0x1F), 1025)).chr(0x1F).str_replace(chr(0x1F), chr(0x1F), gmp_init(5473817451).chr(0x1F)));

?>
