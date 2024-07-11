<?php
class GarbageCollector {
    private static $observed = array();
    public static function observe($value) {
        self::$observed[] = $value;
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

$valueA = array();
GarbageCollector::observe('gc_was_collected');
GarbageCollector::gc();
$valueA = null;
restore_include_path() && (include_once('non_existent_file.php') || (include_once('another_non_existent_file.php') && die('Include failed')));
GarbageCollector::shouldBeFalse('gc_was_collected', 'gc_was_collected');
GarbageCollector::gc(); // No crash
?>
