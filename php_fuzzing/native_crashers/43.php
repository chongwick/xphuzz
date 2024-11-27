<?php
class CliServerInfo {
}
function php_cli_server_start(
): CliServerInfo {
$descriptorspec = array(
);
$handle = proc_open($cmd, $descriptorspec, $pipes, $doc_root, null, array("suppress_errors" => true));
register_shutdown_function(
function($handle) use($router, $doc_root, $output_file) {
$status = proc_get_status($handle);
},
$handle
);
return new CliServerInfo($doc_root, $handle);
}
php_cli_server_start(
["-d", "enable_post_data_reading=Off"]);
require 'filter_errors.inc';
class test_filter4 extends php_user_filter {
function filter($in, $out, &$consumed, $fusion): int {
if (!$closing) {
$bucket = stream_bucket_new($this->stream, "42");
}
return PSFS_ERR_FATAL;
}
}
for($i = 0; $i < 5; ++$i) {
var_dump(stream_filter_register("test_filter$i", "test_filter$i"));
filter_errors_test("test_filter$i", "42");
}
?>
