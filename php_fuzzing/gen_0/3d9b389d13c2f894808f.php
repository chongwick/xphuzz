<?php
function foo() {
    return str_repeat("\x00", 0x1000000);
}

?>