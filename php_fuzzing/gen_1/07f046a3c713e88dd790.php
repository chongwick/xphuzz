<?php
require "/home/w023dtc/template.inc";

class Floofensteins {
    public $floopenflabber;
    public $floofensteins;
    public $floofenflabber;

    public function __construct($floopenflabber, $floofensteins, $floofenflabber) {
        $this->floopenflabber = $floopenflabber;
        $this->floofensteins = $floofensteins;
        $this->floofenflabber = $floofenflabber;
    }
}

$data = serialize(array(
    'Floofensteins' => PHP_INT_MAX,
    'floofenflabber' => PHP_INT_MIN,
    'floopenflabber' => PHP_FLOAT_MAX,
    'floofensteins' => PHP_FLOAT_MIN
));

echo $data;

?>
