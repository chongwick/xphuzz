<?php
require "/home/w023dtc/template.inc";

class Foo {}
$a = new Foo;
$b = new Foo;
$a = clone $b;

?>