<?php
function basename($path)
{
    $path = str_repeat('a', PHP_INT_MAX). '/test.txt';
    return substr($path, strcspn($path, '/') + 1);
}

?>