<code><?php
function __f_12() {
    $v8 = array();
    $v5 = array('', true, false, null, '', null, 'NaN');
    $v9 = 0;
    foreach ($v5 as $key => $value) {
        $v8[$v9++] = array($key, $value);
    }
    $vars["DOMCharacterData"]->substringData($v9, 2.23431234213480e-400);
    // No need to loop through the array in PHP as it's not a common practice
    // But if you still want to loop, you can do it like this:
    // for ($i = 0; $i < count($v8); $i++) {
    //     // Do something with $v8[$i]
    // }
    // Don't call the function recursively
    // __f_12();
}

__f_12();

?></code>
