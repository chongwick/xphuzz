<?php

class ImmutableObject {
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function getData() {
        return $this->data;
    }
}

$data = array();
$immutableObject = new ImmutableObject($data);
$data = $immutableObject->getData();

?>
