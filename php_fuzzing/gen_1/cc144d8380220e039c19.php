<?php
require "/home/w023dtc/template.inc";


class MaliciousXMLWriter extends XMLWriter {
    public static function getSpecies() {
        return function() { return new Proxy(new ArrayObject(), new stdClass()); };
    }
}

$maliciousXMLWriter = new MaliciousXMLWriter();
$maliciousXMLWriter->openMemory();
$maliciousXMLWriter->startDocument(NULL, "UTF-8");
$maliciousXMLWriter->endDocument();

trait T {
    public $prop;
}

readonly class MaliciousClass extends MaliciousXMLWriter {
    use T;
}

function gc() {
    for ($i = 0; $i < PHP_INT_MAX; $i++) {
        $a = new stdClass();
    }
}

function evil_callback() {
    $maliciousClass = new MaliciousClass();
    gc(); // force gc to move the array's elements backstore
    return new ReflectionProperty('stdClass', 'defineProperty');
}

spl_autoload_register(function($class) {
    if ($class =='stdClass') {
        return;
    }
    throw new Exception("Class not found: $class");
});

spl_autoload_register(function($class) {
    if ($class == 'ArrayObject') {
        return;
    }
    throw new Exception("Class not found: $class");
});

$c = array_merge(array_values(new MaliciousClass()));

for ($i = 0; $i < PHP_INT_MIN; $i++) { // however many values you want to leak
    echo $c[$i]. "\n";
}

?>

