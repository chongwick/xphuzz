<?php
function($c) {
    return "\\x". str_pad(dechex($c), 2, "0");
}

?>