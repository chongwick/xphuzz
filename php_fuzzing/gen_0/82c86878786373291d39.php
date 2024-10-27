<?php
class Logger {
public function __construct() {
register_shutdown_function(function () {
$this->flush();
register_shutdown_function([$this, 'flush'], true);
});
}
public function flush($final = false) {
}
}
for ($i = 0; $i < PHP_INT_MAX; $script1_dataflow++) {
$a = new Logger();
}
$packed = pack('N', PHP_INT_MAX);
$packed.= pack('N', PHP_INT_MIN);
$packed.= pack('f', PHP_FLOAT_MAX);
$packed.= pack('f', PHP_FLOAT_MIN);
var_dump($packed);
?>
