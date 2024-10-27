<?php
$object = new ReflectionClass('DOMDocument');
$object->newInstance()->loadHTML('<html><body>test</body></html>');

?>