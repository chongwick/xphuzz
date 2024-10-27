<?php
$big_int = PHP_INT_MAX;
for($i=0; $i<strlen((string)$big_int); $i++) {
    $str = str_split((string)$big_int, 1);
    $str[$i] = chr(0x80);
    echo implode('', $str). "\n";
}
?>
