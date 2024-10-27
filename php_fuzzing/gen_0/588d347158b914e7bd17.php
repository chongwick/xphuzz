<?php
function a() {
    global $a;
    $a = & $a;
}
$a = & $a;
a();

?>