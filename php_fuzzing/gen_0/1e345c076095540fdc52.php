<?php
class MyClass implements \ArrayAccess {
    private $data = [];
    public function offsetGet($key) {
        return $this->data[$key];
    }
    public function offsetSet($key, $value) {
        $this->data[$key] = $value;
    }
    public function offsetUnset($key) {
        unset($this->data[$key]);
    }
    public function offsetExists($key) {
        return isset($this->data[$key]);
    }
}
$obj = new MyClass();
$obj->offsetSet("123", "abc");
$obj->offsetUnset("123");
var_dump($obj->offsetGet("123"));
