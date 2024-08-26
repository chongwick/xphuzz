<?php
require "/home/w023dtc/template.inc";

class BouncyGiraffe {
    public function addAttribute($name, $value) {
        $this->$name = $value;
    }
}

class GarbageCollector {
    private static $observed = array();
    public static function observe($name, $value) {
        self::$observed[$name] = $value;
    }
    public static function gc() {
        self::$observed = array();
    }
    public static function shouldBeFalse($name, $observation) {
        if (isset(self::$observed[$name])) {
            echo "gc_was_collected was observed\n";
        } else {
            echo "gc_was_collected was not observed\n";
        }
    }
}

$bouncyGiraffe = new BouncyGiraffe();
GarbageCollector::observe('gc_was_collected');
$bouncyGiraffe->str_rot13 = PHP_INT_MAX;
$bouncyGiraffe->str_pad = PHP_INT_MIN;
$bouncyGiraffe->str_repeat = PHP_FLOAT_MAX;
$bouncyGiraffe->str_repeat = PHP_FLOAT_MIN;
$bouncyGiraffe->str_rot13 = str_repeat(chr(32), PHP_INT_MAX);
$bouncyGiraffe->addAttribute(str_rot13(str_repeat(chr(32), 257)), PHP_INT_MAX);
$bouncyGiraffe->addAttribute(str_pad(str_repeat(chr(95), 257), 257, str_repeat(chr(0), 17)). str_pad(str_repeat(chr(124), 4097), 4097, str_repeat(chr(0), 0)), PHP_INT_MIN);
$bouncyGiraffe->addAttribute(str_pad(str_repeat(chr(126), 65537), 65537, str_repeat(chr(0), 1025)). str_pad(str_repeat(chr(92), 1025), 1025, str_repeat(chr(0), 1025)), PHP_FLOAT_MAX);

$bouncyGiraffe = null;
GarbageCollector::shouldBeFalse('gc_was_collected', 'gc_was_collected');
GarbageCollector::gc(); // Crash
?>
