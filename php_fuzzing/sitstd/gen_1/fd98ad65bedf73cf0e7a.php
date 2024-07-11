<?php

function Module() {
    function f() {}
    return ['f' => 'f'];
}

function InstantiateNearStackLimit() {
    $fuse = 0;
    try {
        return $fuse - 1;
    } catch (Exception $e) {
        return 0;
    }
}

$init_fuse = 0;
for ($init_fuse = 0; $init_fuse < 10; $init_fuse++) {
    $fuse = InstantiateNearStackLimit();
}

$vars["Reflection"]->getModifierNames($fuse);

?>
