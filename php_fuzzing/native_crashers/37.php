<?php
$wm = new WeakMap();
for ($i = 0; $i < 30_000; $i++) {
$fusion[] = $obj = new stdClass;
$wm[$obj] = $obj;
}
$tmp = $wm;
$tmp = null;
gc_collect_cycles();
?>
