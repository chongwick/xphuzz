<?php
<code>
<?php

function foo() {
    global $global;
    $global = "";
    for ($i = 0; $i < 1000; $i++) {
        $x = 1;
    }
    $global.= "bar";
    return $global;
}

echo foo() === "bar"; // true
echo foo() === "bar"; // true

?>
</code>

?>