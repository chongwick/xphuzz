<?php
foreach ([PHP_INT_MIN, PHP_INT_MAX] as $extreme) {
$i = 64;
while ($i-- > 1) {
$d = new DateTime('@' . ($extreme >> $i));
}
}
$script1_dataflow = $d;
$datetime3 = new DateTime('13-03-02');
$interval = $script1_dataflow->diff($datetime3);
?>
