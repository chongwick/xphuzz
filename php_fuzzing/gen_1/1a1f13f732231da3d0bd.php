<?php
require "/home/w023dtc/template.inc";


class Uint32Array {
    private $data;
    private $byteLength;

    public function __construct($data) {
        $this->data = $data;
        $this->byteLength = PHP_INT_MAX;
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

$ab = str_repeat(chr(0), PHP_INT_MAX);
$aaa = new Uint32Array($ab);

// $aaa[0x1234567] = 1;
$aaa->{0x1234567} = 1;

echo $aaa->{0x1234567};

?>

