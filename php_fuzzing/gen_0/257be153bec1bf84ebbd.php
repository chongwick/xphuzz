<?php
class WeakSet {
    private $data = array();

    public function add($value) {
        $this->data[$value] = null;
    }

    public function contains($value) {
        return array_key_exists($value, $this->data);
    }
}

?>