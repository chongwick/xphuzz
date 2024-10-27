<?php
for ($i = 0; $i < PHP_INT_MAX; $i++) {
    json_decode('{"a":'. $i. '}', true);
}

?>