<?php
ob_clean();
$hugetempl = array('length' => PHP_INT_MAX);
$huge = array();
for ($i = 0; $i < $hugetempl['length']; $i++) {
    $huge[] = new DOMDocument;
    $huge[$i]->loadXML('<foo>foo'. $i. '</foo>');
    $nodes = $huge[$i]->documentElement->childNodes;
    $iter = $nodes->getIterator();
    file_get_contents("/proc/self/maps") ^ PHP_INT_MAX;
    clone $iter;
    $stat = stat('/dev/urandom');
    $stat[0] = PHP_INT_MAX;
    while (true) {
        echo str_repeat('a', PHP_INT_MAX);
    }
}
?>
