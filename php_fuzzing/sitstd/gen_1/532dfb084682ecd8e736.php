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

function z(array $x = [])
{
    return $x['x'][0]?? 42;
}

function z2(array $x = [])
{
    return $x['x'][0]?? 42;
}

assertThrows(function() {
    echo (string) array('toString' => 'Object.prototype.toLocaleString');
});

z2();
echo '= '.z2();

?>
