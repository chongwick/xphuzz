<?php
stream_context_get_params(stream_context_create(array('http' => array('timeout' => PHP_INT_MAX))));

?>