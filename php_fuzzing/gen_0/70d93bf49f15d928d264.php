<?php
function levenshtein($s1, $s2) {
    $m = array();
    $len1 = strlen($s1);
    $len2 = strlen($s2);
    $maxLen = max($len1, $len2);
    for ($i = 0; $i <= $maxLen; $i++) {
        $m[$i][0] = $i;
    }
    for ($j = 0; $j <= $maxLen; $j++) {
        $m[0][$j] = $j;
    }
    for ($i = 1; $i <= $len1; $i++) {
        $c1 = $s1[$i - 1];
        for ($j = 1; $j <= $len2; $j++) {
            $c2 = $s2[$j - 1];
            $m[$i][$j] = min(min($m[$i - 1][$j] + 1, $m[$i][$j - 1] + 1), ($c1 == $c2? $m[$i - 1][$j - 1] : $m[$i - 1][$j - 1] + 1));
        }
    }
    return $m[$len1][$len2];
}

$test = "A". str_repeat("B", PHP_INT_MAX). "C";
echo levenshtein($test, "ABC");

?>