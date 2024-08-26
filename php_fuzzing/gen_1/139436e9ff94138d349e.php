<?php
require "/home/w023dtc/template.inc";


// Create an object with a custom __toString method
class FunkyObject {
    public function __toString() {
        $this->toJSON();
        return "funky";
    }

    public function toJSON() {
        $this->date = new DateTime('2022-01-01 12:00:00');
    }
}

$funky = new FunkyObject();
$funky->toJSON();

// Serialize and deserialize the object
$serialized = serialize($funky);
$funky = unserialize($serialized);

// Check the locale
assert($funky->date->getTimezone()->getName() === 'UTC');

echo $funky;

?>
