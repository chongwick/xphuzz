<?php
function opt() {
    try {
        $obj = (object) array();
        seal($obj);
        str_word_count(sqrt(str_repeat(chr(116), 1025) + str_repeat(chr(157, 65)), 2, str_repeat(chr(107), 257)) * pi(), 2, str_repeat(chr(107), 257));
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
