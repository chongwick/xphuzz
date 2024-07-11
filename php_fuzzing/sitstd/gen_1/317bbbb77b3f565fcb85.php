<code><?php

function f($v) {
  $v['x'] = 0;
  $v[1] = 0.1;
  $v['x'] = array();
}

for ($i = 0; $i < 3; $i++) {
    for ($j = 0; $j < 32767; $j++) {
        // No equivalent in PHP, as Number is a JavaScript primitive type
    }
    for ($j = 0; $j < 2335; $j++) {
        // No equivalent in PHP, as Number is a JavaScript primitive type
    }
    $arr = array_merge(array(), array_fill(0, 65535, 0), array(4294967296));
    $arr = array_merge($arr, array(4294967296));
    f($arr);
}

eval('');
f(array());
f(array(1));
f(array(1));

?></code>
