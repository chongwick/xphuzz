<?php
class TestHooks
{
public function __construct(string $first, public string $last) {
}
}
$o = new TestHooks('first', 'last');
$a = new ArrayObject($o);
foreach ($a as &$c) {
}
?>
