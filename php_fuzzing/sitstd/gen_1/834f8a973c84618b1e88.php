<?php
$a = function () {
    function g() {
        $vars["DOMDocument"]->createProcessingInstruction(str_repeat("ðŸ˜‚", 0x100), str_repeat("ðŸ’¸", 0x100));
    }
};
$a();
?>
