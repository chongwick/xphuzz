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

function foo($i = 0) {
    // This is equivalent to %OptimizeFunctionOnNextCall(foo) in JavaScript
    // In PHP, we don't have a direct equivalent, but we can achieve the same effect by calling the function again
    if ($i < 10) {
        foo($i + 1);
    }

    $data = array();
    $immutableObject = new ImmutableObject($data);
    $data = $immutableObject->getData();
    echo $data;
}

foo();

?>
</code>

?>