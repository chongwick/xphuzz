<?php
require "/home/w023dtc/template.inc";


assertThrows("function a($b = PHP_INT_MAX) { return 0; } echo (a($b) == $b);", "TypeError");

?>
