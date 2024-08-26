<?php
require "/home/w023dtc/template.inc";


$ReallyComplicatedXMLElement = new stdClass();
$ReallyComplicatedXMLElement->addAttribute(chr(PHP_INT_MAX) * 257, chr(193) * 257. chr(155) * 17. chr(147) * PHP_INT_MIN, chr(161) * PHP_INT_MAX. chr(213) * PHP_FLOAT_MAX, chr(214) * PHP_FLOAT_MIN);

$b = array('x' => 0, 'y' => 0, PHP_INT_MAX => '');
$a = array('x' => 0, 'y' => PHP_INT_MAX, PHP_INT_MAX => '');
$b = array_change_key_case($b, CASE_LOWER);
$a = array_change_key_case($a, CASE_LOWER);

// PHP doesn't have a direct equivalent to Object.seal, but we can achieve similar behavior using the following code
class Sealed {
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function __set($key, $value) {
        if (isset($this->data[$key])) {
            $this->data[$key] = $value;
        } else {
            throw new Exception('Cannot set property');
        }
    }

    public function __get($key) {
        return $this->data[$key];
    }
}

$b = new Sealed($b);
$b->x = ''; // This will not throw an exception

echo $ReallyComplicatedXMLElement->getAttribute(chr(PHP_INT_MAX) * 257);

?>
