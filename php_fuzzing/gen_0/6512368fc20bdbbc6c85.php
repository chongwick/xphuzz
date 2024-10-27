<?php

$fp = fopen('http://example.com', 'rb', false, stream_context_get_default());

while (1) {
    $data = fread($fp, 1);
}

?>
