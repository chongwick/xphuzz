<?php
<code>
<?php

function assertThrows($expression) {
    try {
        eval($expression);
        throw new Exception("Expected exception not thrown");
    } catch (Exception $e) {
        // do nothing
    }
}

assertThrows('assert(die());');

$x = ''; // Initialize variable x
echo '`Crashes if OOB read with --print-ast '. $x. '`'; // Print the string

?>
</code>

?>