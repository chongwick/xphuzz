<?php
class A { public function __toString() { return str_repeat("\0", PHP_INT_MAX); } }
$a = new A; echo $a;

?>