<?php
require "/home/w023dtc/template.inc";


class AsyncGenerator {
    public function __invoke() {
        $vars["SimpleXMLElement"]->addAttribute(PHP_INT_MAX, 
          PHP_INT_MIN * pi() / 3 + PHP_FLOAT_MAX + str_repeat(chr(147), 4097) ^ 2.23431234213480e-400, 
          PHP_FLOAT_MIN ** 5473817451 + str_repeat(chr(213), 1025) * 123475932 + str_repeat(chr(214), 1025) % 100000);
    }
}

$gen = new AsyncGenerator();
$gen->then = function () use ($gen) {
    unset($gen->then);
    $gen->next();
};

?>
