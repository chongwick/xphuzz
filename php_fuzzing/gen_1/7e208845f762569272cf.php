<?php
require "/home/w023dtc/template.inc";

for($i=0; $i<PHP_INT_MAX; $i++) {
    $str = '';
    for($j=0; $j<PHP_FLOAT_MAX; $j++) {
        $str.= '(?<a'.$i.$j.'>)|';
    }
    $str.= '(?<b>)';
    $regexp = preg_quote($str);
    $regexp = '/'.$regexp.'/';
    $m = preg_match($regexp, 'xxx', $m);
    $files = glob('./test/mjsunit/wasm/*.php');
    if ($files) {
        foreach ($files as $file) {
            if (strpos($file, 'wasm-module-builder.php')!== false) {
                echo "File found: ". $file. "\n";
                require_once $file;
            }
        }
    } else {
        echo "File not found\n";
    }
}

echo $m;
?>
