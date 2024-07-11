<?php
$m = array(
    'f' => function($x) use (&$m) {
        $x = (int)$x;
        $m['MEM'][$x] = 0;
    }
);
$heap = str_repeat("\0", 1024 * 32 * 8); // Assuming 8 bytes per Uint8Array element
$m['MEM'] = str_split($heap, 1);
$m['f'](-926416896 * 32 * 1024);

$vars["ReflectionProperty"]->getDeclaringClass()->getNamespaceName(). chr(0x1F601). $vars["DateTime"]->format('Y-m-d H:i:s');


?>