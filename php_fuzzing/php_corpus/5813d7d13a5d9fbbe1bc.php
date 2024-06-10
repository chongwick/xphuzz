<?php

function runNearStackLimit($f) {
    return function () use ($f) {
        function t($count = 0) {
            if ($count > 1000) { // Limit the number of recursive calls
                throw new Exception('Maximum recursion depth reached');
            }
            try {
                return t($count + 1);
            } catch (Exception $e) {
                return $f();
            }
        }
        try {
            return t();
        } catch (Exception $e) {
        }
    }();
}

$str = 'hello';
$locale = 'ja-u-co-eor-kf-lower-kn-false'; // Assuming this is the correct locale

function test($getLocaleFromCollator) {
    $localeInCollator = $getLocaleFromCollator($locale);
    $temp = $str;
}

runNearStackLimit(function($args) {
    return (new \Collator($locale))->getLocale();
});

?>
