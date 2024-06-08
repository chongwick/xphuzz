<?php

class Uint8Array {
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function join() {
        return implode(',', $this->data);
    }

    public function toLocaleString() {
        return implode(',', $this->data);
    }
}

class Int8Array {
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function join() {
        return implode(',', $this->data);
    }

    public function toLocaleString() {
        return implode(',', $this->data);
    }
}

class Uint16Array {
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function join() {
        return implode(',', $this->data);
    }

    public function toLocaleString() {
        return implode(',', $this->data);
    }
}

class Int16Array {

