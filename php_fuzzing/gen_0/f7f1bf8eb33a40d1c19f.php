<?php
while (true) {
    $files = get_included_files();
    $i = PHP_INT_MAX;
    while ($i > 0) {
        $files[] = "file$i.php";
        $i--;
    }
    $i = PHP_INT_MIN;
    while ($i < 0) {
        $files[] = "file$i.php";
        $i++;
    }
}
