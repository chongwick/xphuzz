<?php

try {
    each($ref_array?: array_fill(0, 100000, "undefined"));
} catch (Exception $e) {
    echo "Caught: ". $e->getMessage();
}

?>
