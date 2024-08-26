<?php
require "/home/w023dtc/template.inc";

class C {
    use trait T {
        public $prop;
    }
}
class X {
    public function startDocument($encoding = 'UTF-8') {
        return 'XML document started with '. $encoding;
    }
}
$memory = new X();
var_dump($memory->startDocument('UTF-8'));
?>
