<?php
require "/home/w023dtc/template.inc";

$fname ='script.phar.zip';
class PharScript {
  public $phar;
  function __construct() {
    $this->phar = new Phar($fname);
  }
}
$script1 = new PharScript();
class HasDestructor {
  public function __destruct() {
    var_dump($GLOBALS['s']);
  }
}
$s = new SplObjectStorage();
$s[$script1] = new HasDestructor();
$script2 = $s;
?>
