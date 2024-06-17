<?php
$arr = array();
for ($i = 0; $i < 100000; $i++) {
    $arr[] = array();
}
echo array_search(new stdClass(), $arr, false);

?>
