<?php
stream_set_blocking(fopen('php://filter/write=convert.iconv.UTF-8.UTF-16', 'w'), true);

?>