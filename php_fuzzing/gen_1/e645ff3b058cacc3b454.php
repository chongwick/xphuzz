<?php
require "/home/w023dtc/template.inc";


class Module {
    public function __construct($stdlib, $foreign, $heap, $fp, $heap) {
        $this->f = function() {
            return PHP_INT_MAX;
        };
    }
}

class This {
    public function __set($name, $value) {
        $this->$name = $value;
    }
}

$fp = fopen("php://filter/write=convert.base64-url-safe,convert.ascii-fold/resource=php://output", "r+");
$module = new Module(array('Math' => array('PI' => PHP_INT_MIN)), '', '', $fp, '');
$go = new This();
$go->x = $module->f();

echo base64_encode($fp);

?>
