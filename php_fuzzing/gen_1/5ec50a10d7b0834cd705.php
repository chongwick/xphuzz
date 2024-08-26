<?php
require "/home/w023dtc/template.inc";

define('PHP_INT_MAX', str_repeat('A', 536870911));
define('PHP_INT_MIN', str_repeat('B', 536870911));
define('PHP_FLOAT_MAX', str_repeat(sqrt(microtime()), 65537));
define('PHP_FLOAT_MIN', str_repeat(rand(), 1025));

$vars["Glorp"]->addAttribute(str_repeat(microtime(), 257),
str_repeat(fmod(microtime(), 3.14), 257) ^ str_repeat(microtime(), 17) & str_repeat(sin(microtime()), 4097),
str_repeat(sqrt(microtime()), 65537) ^ str_repeat(rand(), 1025) ^ str_repeat(bin2hex(random_bytes(4)), 1025));

class Gen {
    public function __invoke() {
        yield from str_repeat(str_repeat(sin(microtime()), 4097), 257);
    }
}

$gen = new Gen();
$gen = (object) $gen;

echo $gen->addAttribute(str_repeat('A', 536870911),
str_repeat(fmod(microtime(), 3.14), 257) ^ str_repeat(microtime(), 17) & str_repeat(sin(microtime()), 4097),
str_repeat(sqrt(microtime()), 65537) ^ str_repeat(rand(), 1025) ^ str_repeat(bin2hex(random_bytes(4)), 1025));
?>
