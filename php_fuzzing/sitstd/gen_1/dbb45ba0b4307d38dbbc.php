<code><?php

function classOf($object) {
    return get_class($object);
}

class F {}

class MyObject {
    private $x;

    public function __set($name, $value) {
        $this->$name = $value;
    }
}

$object = new MyObject();
$object->x ='result_x';

dechex(rand());

try {
    throw new Exception('fail');
} catch (Exception $e) {
    eval('$x = 7;');
}

?></code>
