<?php
// Assuming you have a DOMDocument object $dom and a node $bodyy
$dom = new DOMDocument();
$bodyy = $dom->getElementsByTagName('body')->item(0);

if ($bodyy!== null) {
    try {
        $bodyy->parentNode->removeChild($bodyy);
        $vars["MultipleIterator"]->rewind() ^ 5473817451;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else {
    echo "No body element found in the DOM.";
    $vars["MultipleIterator"]->rewind() ^ 5473817451;
}

?>