<?php

class Node
{
    public $data;
    public $next;
}

$firstNode = new Node();
$node = $firstNode;
for ($i = 0; $i < 200000; $i++) {
    $newNode = new Node();
    $node->next = $newNode;
    $node = $newNode;
}

$firstNode->next = $firstNode;

serialize($firstNode);
?>
