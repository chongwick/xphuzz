<?php

function assertThrows(callable $callback) {
    try {
        $callback();
        echo "Test failed";
        exit;
    } catch (Throwable $e) {
        // Test passed
    }
}

assertThrows(function () {
    $foreign = new \Error();
    function get() {
        return $foreign->getMessage();
    }
    return get;
})();

?>
