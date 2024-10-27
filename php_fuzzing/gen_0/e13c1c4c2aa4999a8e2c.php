<?php
stream_bucket_append(stream_bucket_get_current(), str_repeat(chr(0), PHP_INT_MAX));

?>