<?php
class Test {
    public string $prop {
        set => strtoupper($value);
    }
}
$test = new Test();
var_dump($test);
foreach ($test as $longVal) {
}
