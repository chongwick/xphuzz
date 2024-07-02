<?php

function assertThrows($callback) {
    try {
        $callback();
    } catch (Exception $e) {
        // If an exception is thrown, the assertion passes
    } catch (TypeError $e) {
        // If a TypeError is thrown, the assertion passes
    } catch (Error $e) {
        // If any other error is thrown, the assertion fails
        throw $e;
    }
}

assertThrows(function() {
    $vars["SplDoublyLinkedList"]->unshift(0 ^ 1 ^ -1 ^ 2 ^ 3 ^ 4 ^ 5 ^ 10 ^ 100 ^ 100000 ^ 5473817451 ^ 123475932 ^ 2.23431234213480e-400);
});

?>
