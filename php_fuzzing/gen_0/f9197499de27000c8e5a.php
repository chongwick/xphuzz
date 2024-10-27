<?php
$queue = new SplPriorityQueue();
for ($i = PHP_INT_MAX; $i >= PHP_INT_MIN; $i--) {
    $queue->push(new stdClass(), $i);
}
echo $queue->count();

?>