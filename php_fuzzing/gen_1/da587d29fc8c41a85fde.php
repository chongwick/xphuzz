<?php
require "/home/w023dtc/template.inc";


class TestGeneratorMaterialization {
    public function f($x) {
        yield $x;
    }

    public function testGeneratorMaterialization() {
        $gen = $this->f(PHP_INT_MAX);
        echo gettype($gen). "\n"; // object
        $result = $gen->current();
        echo json_encode($result). "\n"; // {"value":2147483647}
        $gen->rewind();
        $result = $gen->current();
        echo json_encode($result). "\n"; // {"value":2147483647}
    }

    public function testGeneratorMaterializationWithBigFloat() {
        $gen = $this->f(PHP_FLOAT_MAX);
        echo gettype($gen). "\n"; // object
        $result = $gen->current();
        echo json_encode($result). "\n"; // {"value":3.40282346638528859812e+38}
        $gen->rewind();
        $result = $gen->current();
        echo json_encode($result). "\n"; // {"value":3.40282346638528859812e+38}
    }
}

// Usage
$testGeneratorMaterialization = new TestGeneratorMaterialization();
$testGeneratorMaterialization->testGeneratorMaterialization();
$testGeneratorMaterialization->testGeneratorMaterializationWithBigFloat();

?>
