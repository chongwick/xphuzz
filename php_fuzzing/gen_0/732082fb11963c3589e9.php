<?php
$query = http_build_query(array_fill(0, PHP_INT_MAX, 'a'));
echo $query;
?>
