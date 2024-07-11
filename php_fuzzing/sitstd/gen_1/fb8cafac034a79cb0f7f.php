<?php

function opt() {
    try {
        $obj = (object) array();
        seal($obj);
    } catch (Exception $e) {
        try {
            $tmp = (object) array(
                'toString' => function () {
                }
            );
            $tmp->apply(-1);
        } catch (Exception $e) {
        }
    } finally {
        if (2.2) {
            return;
        }
        try {
            $object = new MyObject();
            $object->x ='result_x';
            classOf($object); // This line is from Code B
        } catch (Exception $e) {
        }
    }
}

opt();

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

eval('$x = 7;'); // This line is from Code B

?>
