<?php
function opt() {
    try {
        $obj = (object) array();
        seal($obj);
    } catch (Exception $e) {
        try {
            $tmp = (object) array(
                'toString' => function () {
                }
            );
            $tmp->apply(-1);
        } catch (Exception $e) {
        }
    } finally {
        if (2.2) {
            return;
        }
        try {
            // This code should be dead.
        } catch (Exception $e) {
        }
    }
}

opt();

?>