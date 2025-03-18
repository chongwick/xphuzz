<?php
$str = '';
for($i=0; $i<0x2000; $i++) {
    $str.= '(?<a'.$i.'>)|';
}
$str.= '(?<b>)';
$regexp = preg_quote($str);
$regexp = '/'.$regexp.'/';
$m = preg_match($regexp, 'xxx', $m);
print_r($m);
?>
