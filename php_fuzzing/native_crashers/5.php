<?php
$xw = new XMLWriter();
$xw->openMemory();
$xw->startDocument(NULL, "UTF-8");
$xw->endDocument();
trait T {
    public $prop;
}
readonly class C {
    use T;
}
?>
