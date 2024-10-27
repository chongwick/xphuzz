<?php
$context = stream_context_create(array(
   'socket' => array(
        'bindto' => array(
            PHP_INT_MAX,
            PHP_INT_MIN,
        ),
    ),
));
stream_context_set_default($context);

?>