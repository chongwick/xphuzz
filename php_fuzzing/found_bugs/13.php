<?php
function processVar($var) {
    if (is_object($var)) {
        return (string)$var;
    } elseif (is_array($var)) {
        return implode(',', array_map('processVar', $var));
    } else {
        return $var;
    }
}

function varFusion($var1, $var2, $var3) {
    $vars = array($var1, $var2, $var3);
    foreach ($vars as $i => $v1) {
        foreach ($vars as $j => $v2) {
            if ($i < $j) {
                $result["concat_{$i}_{$j}"] = processVar($v1).''. processVar($v2);
            }
        }
    }
    return $result;
}

$xml = '<?xml version="1.0" encoding="utf-8"?>
<test>
</test>';
$root = simplexml_load_string($xml);
$clone = clone $root;
$script1_dataflow = $clone;
$script1_connect = $clone;

class foo {
    public function __construct($n = 0) {
    }
}

try {
    $y = $script1_dataflow->__construct(1);
} catch (Exception $e) {
}

varFusion($script1_connect, $script2_connect, $random_var);
?>
