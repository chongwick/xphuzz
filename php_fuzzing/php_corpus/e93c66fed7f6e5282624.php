<?php

function testAsync($assert) {
    $g = function() {
        $promise = new Promise(function($resolve, $reject) {
            $reject(new ReferenceError());
        });
        return $promise;
    };
    $g()->then(null, function ($e) {
        if ($e instanceof ReferenceError) {
            echo "Test passed\n";
        } else {
            echo "Test failed\n";
        }
    });
}

testAsync(function ($assert) {
    testAsync($assert);
});

?>
