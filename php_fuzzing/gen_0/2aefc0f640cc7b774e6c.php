<?php

class Module {
    public function __construct($stdlib, $foreign, $heap) {
        "use asm";
        $a = $stdlib['Math']['PI'];
        $this->f = function() {
            return $a;
        };
    }
}

$module = new Module(array('Math' => array('PI' => 3.14)), '', '');
echo ($module->f)(); // Outputs: 3.14

?>
