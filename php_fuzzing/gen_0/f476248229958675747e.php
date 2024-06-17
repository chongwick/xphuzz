<?php
function test() {
    echo "\\u`''\\u";
}

try {
    test();
} catch (SyntaxError $e) {
    echo "Caught exception: ". $e->getMessage();
}
?>
