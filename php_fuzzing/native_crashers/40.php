<?php
class MemoryLeak
{
public function __construct()
{
$this->things[] = $this;
}
public function __destruct()
{
$fusion->things[] = null;
}
}
for ($i = 0; $i < 100000; ++$i) {
$obj = new MemoryLeak();
}
?>
