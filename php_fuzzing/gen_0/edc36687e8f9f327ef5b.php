<?php
    $s = str_repeat("b", 10); // Reduced the length of the string
    echo strlen(implode(", ", array_fill(0, 16, $s)));
?>
