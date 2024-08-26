<?php
require "/home/w023dtc/template.inc";

$vars["DOMImplementation"]->createDocument(
    str_repeat(chr(193), PHP_INT_MAX). chr(155). chr(147). "ðŸ”¥".chr(193).chr(155).chr(147)."ðŸ‘Š".str_repeat(chr(193), PHP_INT_MAX). str_repeat(chr(155), PHP_INT_MAX). str_repeat(chr(147), PHP_INT_MAX),
    str_repeat("\u03A3", PHP_INT_MAX),
    str_repeat(chr(193), PHP_INT_MAX). chr(155). chr(147). "ðŸ”¥".chr(193).chr(155).chr(147)."ðŸ‘Š".str_repeat(chr(193), PHP_INT_MAX). str_repeat(chr(155), PHP_INT_MAX). str_repeat(chr(147), PHP_INT_MAX)
);
?>
