<?php
$fp = fopen('non_existent_file', 'rb');
fread($fp, PHP_INT_MAX);
fclose($fp);

?>