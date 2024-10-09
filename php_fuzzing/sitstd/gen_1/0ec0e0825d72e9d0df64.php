<?php

$arr = array_fill(0, 9000, null);

for ($j = 0; $j < 40; $j++) {
    array_shift(array_keys($arr));
    array_fill(0, 64386, null);
}

echo count_chars(gzuncompress(gzcompress(gzinflate(gzdeflate(gzcompress(gzinflate(gzcompress(gzinflate(gzcompress(str_repeat(chr(47), 4097))))))))), 2);

?>
