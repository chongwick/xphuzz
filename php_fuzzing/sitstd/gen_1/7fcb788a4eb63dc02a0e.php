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

$propName = "WebCore::HiddenProperty::listener";
$obj = array();

class MyObject {
    public function __set($name, $value) {
        if ($name == $propName) {
            unset($this->$propName);
            $this->hiddenObj = $this;
        }
    }
}

$obj = new MyObject();

function addEvent($event, $obj) {
    // Add event logic here
    echo "Added event $event for object\n";
}

function removeEvent($event, $obj) {
    // Remove event logic here
    echo "Removed event $event for object\n";
}

addEvent('message', $obj);

GarbageCollector::observe($obj);

$obj->$propName = 0x100;
removeEvent('message', $obj);

GarbageCollector::gc();

GarbageCollector::shouldBeFalse($propName, $propName);

var_dump($obj);

?>
