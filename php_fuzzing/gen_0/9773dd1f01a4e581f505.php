<?php
$resource = fopen("php://filter/convert.base64-encode/resource=../../../../etc/passwd", "r");
if (is_resource($resource)) {
    echo "Resource is valid";
} else {
    echo "Resource is not valid";
}
?>
