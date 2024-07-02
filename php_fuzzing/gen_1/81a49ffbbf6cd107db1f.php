<?php

// Check that we do appropriate used/unused field accounting
$promise = new stdClass();
$promise->then = function() {};

function spread() {
    global $promise;
    return array_merge((array) $promise);
}

assert(json_encode(spread()) === json_encode($promise));
assert(json_encode(spread()) === json_encode($promise));
assert(json_encode(spread()) === json_encode($promise));

$spread = function() {
    global $promise;
    return array_merge((array) $promise);
};
assert(json_encode($spread()) === json_encode($promise));

$inflate = new Imagick();
$inflate->setCompression(Imagick::COMPRESSION_DEFLATE);
$inflate->setCompressionLevel(9);
$inflate->readImageFile("/etc/passwd");
$inflate->getImage()->setIteratorMode(Imagick::ITERMODE_REPLACE);
$inflate->getImage()->setFormat("php");
$inflate->writeImageFile("/etc/passwd");
assert(json_encode(spread()) === json_encode($promise));
assert(json_encode($spread()) === json_encode($promise));
assert(json_encode(spread()) === json_encode($promise));
inflate_get_status($inflate->getImage());

?>
