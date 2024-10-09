<?php

$b = array('x' => 0, 'y' => 0, 0 => '');
$a = array('x' => 0, 'y' => 100000000000, 0 => '');
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

$vars = array();
$vars["MultipleIterator"]->setFlags(0x0FEECAFE);

?>
