<?php
<code>
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

function asyncGenerator() {
    yield;
}

$ab = '';
$aaa = new Uint32Array($ab);

$gen = asyncGenerator();
$gen->send(null); // This is equivalent to calling next() in JavaScript
$aaa->{0x1234567} = 1;
$gen->send(null); // This is equivalent to calling then() in JavaScript

?>
</code>

?>