<?php

class Int64 {
    private $bytes;

    public function __construct($v) {
        $this->bytes = new stdClass();
        switch (gettype($v)) {
            case 'integer':
                $v = dechex($v);
            case'string':
                if (substr($v, 0, 2) == '0x')
                    $v = substr($v, 2);
                if (strlen($v) % 2 == 1)
                    $v = '0'. $v;
                $bigEndian = unpack('C*', pack('H*', $v));
                $this->bytes->data = array_reverse($bigEndian);
                break;
            case 'object':
                if ($v instanceof Int64) {
                    $this->bytes = $v->getBytes();
                } else {
                    if (count($v)!= 8)
                        throw new TypeError("Array must have exactly 8 elements.");
                    $this->bytes->data = $v;
                }
                break;
            case 'null':
                break;
            default:
                throw new TypeError("Int64 constructor requires an argument.");
        }
    }

    public static function fromDouble($d) {
        $bytes = pack('d', $d);
        return new Int64(unpack('C*', $bytes));
    }

    public function canRepresentAsDouble() {
        // Check for NaN
        return!(ord($this->bytes->data[7]) == 0xff && (ord($this->bytes->data[6]) == 0xff || ord($this->bytes->data[6]) == 0xfe));
    }

    public function asDouble() {
        if (!$this->canRepresentAsDouble()) {
            throw new RangeError("Integer can not be represented by a double");
        }

        return unpack('d', pack('C*', array_reverse($this->bytes->data)))[1];
    }

    public function getBytes() {
        return $this->bytes;
    }

    public function asJSValue() {
        if ((ord($this->bytes->data[7]) == 0 && ord($this->bytes->data[6]) == 0) || (ord($this->bytes->data[7]) == 0xff && ord
