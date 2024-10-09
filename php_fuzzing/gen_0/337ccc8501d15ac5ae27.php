<?php

class TestGeneratorMaterialization {
    public function f($x) {
        yield $x;
    }

    public function testGeneratorMaterialization() {
        $gen = $this->f([23]);
        echo gettype($gen). "\n"; // object
        $result = $gen->current();
        echo json_encode($result). "\n"; // {"value":23}
        $gen->rewind();
        $result = $gen->current();
        echo json_encode($result). "\n"; // {"value":23}
    }
}

class TestGeneratorMaterializationWithProperties {
    public function f($x = 23) {
        yield $x;
    }

    public function g() {
        $gen = $this->f();
        return $gen;
    }

    public function h() {
        return $this->f();
    }

    public function testGeneratorMaterializationWithProperties() {
        for ($i = 0; $i < 100; $i++) {
            $gen = $this->g();
            $this->h();
        }
        $this->h();  // In {h} the generator does not escape.
    }
}

// Usage
$testGeneratorMaterialization = new TestGeneratorMaterialization();
$testGeneratorMaterialization->testGeneratorMaterialization();

$testGeneratorMaterializationWithProperties = new TestGeneratorMaterializationWithProperties();
$testGeneratorMaterializationWithProperties->testGeneratorMaterializationWithProperties();

?>
