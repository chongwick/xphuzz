<?php

class Uint32Array {
    private $data;
    private $byteLength;

    public function __construct($data) {
        $this->data = $data;
        $this->byteLength = 0xFFFFFFFC;
    }

    public function __get($index) {
        if ($index >= 0 && $index < $this->byteLength / 4) {
            return (int)unpack('L', substr($this->data, $index * 4, 4))[1];
        } else {
            return null;
        }
    }

    public function __set($index, $value) {
        if ($index >= 0 && $index < $this->byteLength / 4) {
            $this->data = substr_replace($this->data, pack('L', $value), $index * 4, 4);
        }
    }

}

gc_enable(42,'space odyssey', array('garbage', 'collection', 'in', 'a','strange', 'way'));

$ab = '';
$aaa = new Uint32Array($ab);

// $aaa[0x1234567] = 1;
$aaa->{0x1234567} = 1;

?>
