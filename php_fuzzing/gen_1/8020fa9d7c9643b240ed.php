<?php
require "/home/w023dtc/template.inc";


class WeakSet {
    private $data = array();
    private $iterable = array_fill(0, PHP_INT_MAX, PHP_INT_MIN);

    public function add($value) {
        $this->data[$value] = null;
    }

    public function contains($value) {
        return array_key_exists($value, $this->data);
    }

    public function __toString() {
        $map = new \SplDoublyLinkedList();
        foreach ($this->iterable as $v) {
            $map->push($v);
        }
        return (string)$map;
    }
}

$ws = new WeakSet();
$ws->add(PHP_INT_MAX);
$ws->add(PHP_INT_MIN);
echo $ws;

?>
