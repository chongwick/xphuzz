<?php

class MyArray implements ArrayAccess, Countable {
    private $data = [];

    public function __construct($initialSize = 0) {
        if ($initialSize > 0) {
            $this->data = array_fill(0, $initialSize, null);
        }
    }

    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

    public function offsetGet($offset) {
        #[\ReturnTypeWillChange]
        return $this->data[$offset];
    }

    #[\ReturnTypeWillChange]
    public function offsetExists($offset) {
        return isset($this->data[$offset]);
    }

    public function offsetUnset($offset) {
        unset($this->data[$offset]);
    }

    public function count() {
        return count($this->data);
    }

    public static function getSpecies() {
        return function() {
            return new MyArray();
        };
    }
}

class ProxyProperties {
    public function __define($name, $value, $options = []) {
        // You can implement your own logic here
        // This method is called when a property is defined on an object
    }
}

$b = new MyArray(65535);
$b[1] = 0.1;
$c = array_merge($b);

function gc() {
    gc_collect_cycles();
}

?>
