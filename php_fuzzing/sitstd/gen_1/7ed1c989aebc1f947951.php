<?php

$o = array('3');
function foo($i) {
    $o['x'] = $i;
}
foo("string");
unset($o['x']);
// PHP does not have a direct equivalent of Object.preventExtensions() and Object.seal()
// but we can achieve similar behavior using array methods
$o = array_values($o);
$o = array_flip(array_flip($o));

$dom = new DOMDocument();
$bodyy = $dom->getElementsByTagName('body')->item(0);

if ($bodyy!== null) {
    try {
        $bodyy->parentNode->removeChild($bodyy);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else {
    echo "No body element found in the DOM.";
}

echo 'foo';
foo(0);
echo $o['x']; // outputs 0


?>