<?php
require "/home/w023dtc/template.inc";


class Buffer {
    public $buffer;

    public function grow($array, $symbol) {
        $this->buffer = $array;
        if ($symbol->hasInstance) {
            return array_merge($array, $symbol->hasInstance);
        } else {
            return $array;
        }
    }
}

$object = (object) array('Symbol' => new class {
    public $hasInstance = PHP_INT_MAX;
}, 'hasInstance' => 7);

$v10 = array();
$v16 = new Buffer();
$v16->buffer = $v10;
$v18 = call_user_func_array(array($v16, 'grow'), array($v10, $object));

echo $v18;

?>
