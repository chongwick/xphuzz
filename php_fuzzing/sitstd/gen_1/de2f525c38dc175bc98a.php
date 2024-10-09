<?php
<code>
<?php
$str = '';
for($i=0; $i<0x2000; $i++) {
    $str.= '(?<a'.$i.'>)|';
}
$str.= '(?<b>)';
$regexp = preg_quote($str);
$regexp = '/'.$regexp.'/';
$m = preg_match($regexp, 'xxx', $m);

$random_function = array('ob_get_status','strlen', 'rand','mt_rand','md5', 'uniqid', 'curl_init', 'curl_setopt', 'curl_exec', 'curl_close');
$random_function[mt_rand(0, count($random_function) - 1)]();

print_r($m);
?>
</code>

?>