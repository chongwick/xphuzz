<?php
require "/home/w023dtc/template.inc";

$arrElement = str_repeat("-", 19). "U\x30". str_repeat("-", 7);
$str = '"'. "\x06length^\x00U\x02A\x01y$\x00\x01@\x03\x03". $arrElement. '$\x00'. chr(PHP_INT_MAX);
$oobArray = json_decode($str, true);
if (!isset($oobArray[0])) {
    return;
}
$oobObject = $oobArray[0];
$dv = $oobArray[1];
$ab = new \stdClass();
$ab->{"0"} = array();
$ab->{"length"} = str_repeat(chr(1337), 257);
$ab->{"0x42"} = preg_replace('/^.{257}$/s', '0x42', str_repeat(chr(193), 257). str_repeat(chr(155, 17). str_repeat(chr(147, 4097)));
$ab->{"gzcompress"} = gzcompress(gzuncompress(bin2hex(str_repeat(chr(161), 65537). str_repeat(chr(213), 1025). str_repeat(chr(214), 1025))));
echo json_encode($ab);
?>
