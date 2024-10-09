<?php
$db = new PDO('sqlite::memory:');
$x = $db->query('select 1 as queryStringxx');
$y = $x->fetch(PDO::FETCH_LAZY);
$script1_dataflow = $y;
$script1_dataflow->documentElement->firstChild->nextElementSibling->textContent = "Ã©";
?>
