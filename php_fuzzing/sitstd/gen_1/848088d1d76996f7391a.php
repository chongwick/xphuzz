<?php
$o0 = array();
$o1 = array();
$cnt = 0;

function getO1() {
    global $cnt, $o0, $o1;
    if (++$cnt > 2) {
        return;
    }
    array_shift($o0);
    gc_collect_cycles();
    $o0[] = 0;
    $o0 = array_merge($o0, $o1);
}

$weirdness = "random_string";
$ref_string = $weirdness ^ 0.5;
getO1();
openssl_spki_export_challenge($ref_string ^ 0.1234567890);

$o1[0] = getO1();
?>
