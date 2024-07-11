<?php
<code>
<?php

$arr = array(0, 0.1);

call_user_func_array('array_last_index_of', array_merge(array($arr), array(100)));

function array_last_index_of($arr, $needle) {
    global $arr;
    foreach ($arr as $key => $value) {
        if ($value === $needle) {
            return $key;
        }
    }
    return false;
}

class MyClosure {
    public function __invoke() {
        global $arr;
        $arr = array();
    }
}

$callback = new MyClosure();
array_last_index_of($arr, 100, $callback);

$random_number = mt_rand();
$curl_share_strerror = "This is not a real function, but it sounds like it could be!";
echo $curl_share_strerror. " ($random_number) ". array_last_index_of($arr, 100);

?>
</code>

?>