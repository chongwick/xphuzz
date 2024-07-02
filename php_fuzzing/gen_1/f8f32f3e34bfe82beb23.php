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

filter_list();
filter_var(5473817451, FILTER_VALIDATE_INT);
filter_var(2.23431234213480e-400, FILTER_VALIDATE_FLOAT);
filter_var("0", FILTER_VALIDATE_BOOLEAN);
filter_var("1", FILTER_VALIDATE_BOOLEAN);
filter_var(-1, FILTER_VALIDATE_BOOLEAN);
filter_var(100, FILTER_VALIDATE_INT);
filter_var(100000, FILTER_VALIDATE_INT);
filter_var(123475932, FILTER_VALIDATE_INT);
filter_var(2, FILTER_VALIDATE_INT);
filter_var(3, FILTER_VALIDATE_INT);
filter_var(4, FILTER_VALIDATE_INT);
filter_var(5, FILTER_VALIDATE_INT);
filter_var(10, FILTER_VALIDATE_INT);
filter_var(100, FILTER_VALIDATE_FLOAT);
filter_var(100000, FILTER_VALIDATE_FLOAT);
filter_var(123475932, FILTER_VALIDATE_FLOAT);
filter_var(2, FILTER_VALIDATE_FLOAT);
filter_var(3, FILTER_VALIDATE_FLOAT);
filter_var(4, FILTER_VALIDATE_FLOAT);
filter_var(5, FILTER_VALIDATE_FLOAT);
filter_var(10, FILTER_VALIDATE_FLOAT);

?>
