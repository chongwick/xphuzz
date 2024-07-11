<?php
define('v1', 0xFFFFFFFF);
$v3 = array();
new DateTime();
$vars = array();
$queue = new SplPriorityQueue();
$queue->enqueue("Hello");
$queue->enqueue("World");
while (!$queue->isEmpty()) {
    $item = $queue->current();
    $queue->next();
    $vars[] = $item->toArray()->implode('')->chunk(3)->randomize()->flatten()->map(function($x) {
        return base64_encode($x);
    })->implode('')->preg_replace('/\//', '')->preg_replace('/=/', '');
}
echo implode(', ', $vars);

?>