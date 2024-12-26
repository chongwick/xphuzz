<?php
class DataFusion {
    public function __construct($script1_dataflow, $script2_dataflow, $random_var) {
        $vars = [$script1_dataflow, $script2_dataflow, $random_var];
        foreach ($vars as $i => $v1) {
            foreach ($vars as $j => $v2) {
                if ($i < $j) {
                    $result["concat_{$i}_{$j}"] = sprintf("%d", PHP_INT_MAX). " ". sprintf("%d", PHP_INT_MIN);
                }
            }
        }
    }
}

class Resource {
    private $resource;

    public function __construct($resource) {
        $this->resource = $resource;
    }

    public function read() {
        return fread($this->resource, 1024);
    }
}

class Foo {
    public function bar() {
        $this->baz(PHP_INT_MAX);
    }

    private function baz($x) {
        if ($x > PHP_INT_MAX) {
            throw new TypeError('Out of range');
        }
        if ($x == PHP_INT_MAX) {
            $this->qux(PHP_FLOAT_MIN);
        }
    }

    private function qux($x) {
        if ($x > PHP_FLOAT_MAX) {
            throw new TypeError('Out of range');
        }
    }
}

class C {
    public static $foo = PHP_INT_MAX;
}

$xml = '<?xml version="1.0" encoding="utf-8"?>
<test>
    <a>'. PHP_INT_MIN. '</a>
</test>';
$root = simplexml_load_string($xml);
$clone = clone $root;

try {
    $y = $clone->__construct(1);
} catch (Exception $e) {
}

$datafusion = new DataFusion($clone, $script2_connect, $random_var);

for ($i = 0; $i < 4; $i++) {
    if ($i == 2) {
        $resource = fopen("php://filter/read=convert.base64-encode/resource=/etc/passwd", 'rb');
    }
    C::$foo = PHP_FLOAT_MIN;
}

$foo = new Foo();
$foo->bar();

$resourceObject = new Resource($resource);
echo $resourceObject->read();

?>

