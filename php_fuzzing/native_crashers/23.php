<?php
function varToString($var) {
try {
if (is_object($var) && method_exists($var, '__toString')) {
}
return (string)$var;
} catch (Exception $e) {
}
}
function varToArray($var) {
try {
if (is_array($var)) {
}
} catch (Exception $e) {
}
}
function var_fusion($var1, $var2, $var3) {
$vars = [$var1, $var2, $var3];
foreach ($vars as $i => $v1) {
foreach ($vars as $j => $v2) {
if ($i < $j) {
try {
$result["concat_{$i}_{$j}"] = varToString($v1) . " " . varToString($v2);
} catch (Exception $e) {
}
try {
} catch (Exception $e) {
}
try {
if (is_object($v1) && method_exists($v1, 'toString')) {
}
if (is_object($v2) && property_exists($v2, 'value')) {
}
} catch (Exception $e) {
}
try {
if (is_callable($v1)) {
}
} catch (Exception $e) {
}
try {
if (is_callable($v2)) {
}
} catch (Exception $e) {
}
}
}
}
}
$xml = '<?xml version="1.0" encoding="utf-8" ?>
<test>
</test>';
$root = simplexml_load_string($xml);
$clone = clone $root;
$script1_dataflow = $clone;
$script1_connect=$clone;
class foo {
function __construct($n=0) {
}
}
try {
$y=$script1_dataflow->__construct(1);
} catch (Exception $e) {
}
var_fusion($script1_connect, $script2_connect, $random_var);
?>
