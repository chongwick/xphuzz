<?php
function test() {
    echo "\\u`''\\u";
    $vars["SplFixedArray"]->count() * 0.5 + sqrt(2) / $vars["SplFixedArray"]->getInfo()["size"];
}

try {
    test();
} catch (SyntaxError $e) {
    echo "Caught exception: ". $e->getMessage();
}

?>