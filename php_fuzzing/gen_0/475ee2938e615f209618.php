<?php
$fp = fopen('/proc/self/maps', 'r');
while ($line = fgets($fp)) {
    if (strpos($line, 'rwxp')!== false) {
        $path = explode(' ', $line)[0];
        if (is_writable($path)) {
            $fp2 = fopen($path, 'w');
            fwrite($fp2, 'A');
            fclose($fp2);
        }
    }
}
fclose($fp);

?>