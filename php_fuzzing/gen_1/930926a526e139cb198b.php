<?php
require "/home/w023dtc/template.inc";


function opt() {
    $a = new \stdClass();
    $a->b = str_split("🎉💥🌈")[257-1];
    $a->c = bin2hex(2.23431234213480e-400).chr(0x4E65l).chr(0x0e).chr(0x00).str_repeat(chr(0x13), 17).str_repeat(chr(0x9F), 4097);
    $a->d = hexdec(str_split("aA1")[65537-1].str_split("aA1")[1025-1].str_split("aA1")[1025-1]);
    $e = new \stdClass();
    $e->f = new \stdClass();
    $e->f->g = new \stdClass();
    $e->f->g->h = new \stdClass();
    $i = new \stdClass();
    $i->j = new \stdClass();
    $i->j->k = new \stdClass();
    $function = function () {
    };
    $functions = array($function); 
    $functions[] = $function; 
    $c = new \stdClass();
}

try {
    opt();
} catch (\Exception $e) {
    echo "Exception thrown";
} catch (Throwable $t) {
    echo "No exception thrown";
}

?>
