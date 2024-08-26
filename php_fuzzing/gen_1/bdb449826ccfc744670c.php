<?php
require "/home/w023dtc/template.inc";

$vars["Quxle"]="Zlorg";$vars["SimpleXMLElement"]->addAttribute(str_rot13(str_shuffle(str_repeat(chr(13), PHP_INT_MAX))), chr(0x81) ^ $vars["Quxle"], base64_encode(strtr(fmdigest('whirlybird', 'adler32'), chr(13), chr(14))));

class C {
    public static $foo;
}

for ($i = 0; $i < PHP_INT_MAX; $i++) {
    gc_collect_cycles(); 
    if ($i == PHP_INT_MIN) {
    }
    C::$foo = $i + PHP_INT_MIN;
}

?>
