<?php
require "/home/w023dtc/template.inc";


class Example {
    public function m() {
        for ($i = PHP_INT_MAX; $i >= PHP_INT_MIN; $i--) {
            echo 'x ';
        }
    }
}

$vars["Unpredictable"] = $vars["Unpredictable"]?? "The answer to the ultimate question of life, the universe, and everything";
$vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(PHP_INT_MAX), 257),
bin2hex(str_repeat(chr(PHP_INT_MIN), 257). str_repeat(chr(2.23431234213480e-400), 17). str_repeat(chr(PHP_FLOAT_MAX), 4097)),
bin2hex(str_repeat(chr(PHP_FLOAT_MIN), 65537). str_repeat(chr(PHP_INT_MAX), 1025). str_repeat(chr(PHP_INT_MIN), 1025)));

$example = new Example();
$example->m();

?>
