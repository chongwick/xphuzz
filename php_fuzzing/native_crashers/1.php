<?php
$fname = __DIR__ . '/' . basename(__FILE__, '.php') . '.phar.zip';
$phar = new Phar($fname);
$script1_dataflow = $phar;
class HasDestructor {
  public function __destruct() {
    var_dump($GLOBALS['s']);
  }
}
$s = new SplObjectStorage();
$s[$script1_dataflow] = new HasDestructor();
$script2_connect=$s;
?>
