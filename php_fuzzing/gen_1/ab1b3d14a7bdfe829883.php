<?php
require "/home/w023dtc/template.inc";


function f($x) {
    $o = array('a' => PHP_INT_MIN, 'b' => PHP_INT_MAX);
    if ($x == 0) {
        $o['a'] = PHP_FLOAT_MAX;
    } else {
        if ($x <= 1) {
            if ($x == 2) {
                $o['a'] = PHP_FLOAT_MIN;
            } else {
                $o['a'] = PHP_INT_MIN;
            }
        } else {
            if ($x == 2) {
                $o['a'] = 'x';
            } else {
                $o['a'] = 'x';
            }
            $o['b'] = PHP_INT_MAX;
        }
    }
    return $o['a'];
}

echo f(0)."<br>";
echo f(1)."<br>";
echo f(2)."<br>";
echo f(3)."<br>";
echo f(0)."<br>";
echo f(1)."<br>";
echo f(2)."<br>";
echo f(3)."<br>";

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

$ab = '';
$aaa = new Uint32Array($ab);

// $aaa[0x1234567] = 1;
$aaa->{0x1234567} = 1;

?>
