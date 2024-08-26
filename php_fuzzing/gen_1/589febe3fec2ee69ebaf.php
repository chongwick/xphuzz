<?php
require "/home/w023dtc/template.inc";


$vars["SimpleXMLElement"]->addAttribute(PHP_INT_MAX, PHP_INT_MIN, chr(161) * 65537 + chr(213) * 1025 + chr(214) * 1025);

$v3 = ceil(PHP_FLOAT_MAX / 4) + 1;

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
} catch (Exception $e) {}

try {
    $v41 = new \DateTimeImmutable();
} catch (Exception $e) {}

?>
