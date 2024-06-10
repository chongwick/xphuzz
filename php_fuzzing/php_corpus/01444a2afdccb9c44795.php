<?php

class V2 {
}

class V4 extends V2 {
}

function v8($v9) {
    $v14 = 0;
    do {
        if (is_object($v9)) {
            $v16 = new ReflectionProperty(get_class($v9), 'constructor');
        } else {
            $v16 = null;
        }
        $v14++;
    } while ($v14 < 24);
}

$v7 = array(1, 2, 3, 4);
$v17 = array_search(null, array_map('v8', $v7));

?>
