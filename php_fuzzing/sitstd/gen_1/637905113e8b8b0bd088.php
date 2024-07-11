<?php
date_default_timezone_set('America/New_York');
$date0 = strtotime('1995-12-17 03:24:00');
$dateFormat = date('F j, Y H:i:s', $date0);

$vars = array();
$vars["SplDoublyLinkedList"] = new SplDoublyLinkedList();
$vars["SplDoublyLinkedList"]->push(array_map(function($x) {
    return $x * pow(2, 5);
}, range(0, 10)));

?>
