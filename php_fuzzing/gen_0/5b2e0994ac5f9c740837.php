<?php
function explodeMe($str) {
    $intMax = PHP_INT_MAX;
    return lcfirst($str.$intMax);
}

echo explodeMe("PHP_INT_MAX");

?>