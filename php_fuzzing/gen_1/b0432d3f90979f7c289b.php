<?php

if (class_exists('Worker')) {
    function __f_4() {}
    $__v_2 = new Worker(__f_4);
}

$v3 = ceil(4294967296 / 4) + 1;

class MyObject {
    public function __get($key) {
        if ($key === 1) {
            $this->$key = str_repeat('', 32768);
        }
        return null;
    }
}

try {
    $v38 = new \stdClass();
    $v38->byteLength = $v3;
    $v38->worker = $__v_2;
} catch (Exception $e) {}

try {
    $v41 = new \DateTimeImmutable();
    $v41->worker = $__v_2;
} catch (Exception $e) {}

?>

