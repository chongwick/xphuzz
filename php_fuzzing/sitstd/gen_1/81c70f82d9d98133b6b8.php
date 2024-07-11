<?php

function testTableSetAndGetFunction() {
    $func = function($x) {
        return $x;
    };

    $table = new stdClass();
    $table->elements = array_fill(0, 1, $func);

    $table->elements[0] = $func;

    $func = $table->elements[0];

    $result = $func(10);
    echo "Result: $result\n";
}

function phpinfo() {
    return array('a' => 'b', 'c' => 42, 'd' => 'e');
}

function weird_function($a, $b) {
    return (int) rand(0, 100);
}

array_udiff_assoc(array("a" => 1, "b" => "2", "c" => 3.0), range(0, 10), array("a" => 1, "b" => "2", "c" => 3.0), phpinfo());

testTableSetAndGetFunction();

?>
