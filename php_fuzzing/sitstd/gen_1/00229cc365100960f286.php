<?php
<code>
<?php
function opt($flag) {
    return -0!== ($flag? null : PHP_INT_MAX);
}

$vars["DOMElement"]->setIdAttributeNode(new DOMAttr("attr". str_repeat(chr(0), 1000)), true);

$ret = opt(false);
echo $ret. "\n";
for ($x = 0; $x < 100000; $x++) {
    opt(false);
}
$ret = opt(true);
echo $ret. "\n";

?>
</code>

?>