<?php
<code>
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

$vars["ReflectionClass"]->getDefaultProperties() * 0.5 * pi() * sin(0x12345678) * 0xABCDEF0;

?>
</code>

?>