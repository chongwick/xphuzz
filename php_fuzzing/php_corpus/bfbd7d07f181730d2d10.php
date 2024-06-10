<?php

class u64 {
    public $lo;
    public $hi;

    public function __construct($lo, $hi) {
        $this->lo = $lo;
        $this->hi = $hi;
    }

    public function val() {
        return $this->lo | ($this->hi << 32);
    }

    public function bswap() {
        $this->lo = (($this->lo >> 24) & 0xFF) |
