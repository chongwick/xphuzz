<?php
<code>
<?php
class WasmModuleBuilder {
    private $functions = [];
    private $currentFunction = null;

    public function addFunction($name, $sig) {
        $this->currentFunction = ['name' => $name,'sig' => $sig, 'body' => []];
        $this->functions[] = $this->currentFunction;
    }

    public function addBody($body) {
        if ($this->currentFunction) {
            $this->currentFunction['body'] = array_merge($this->currentFunction['body'], $body);
        }
    }

    public function exportFunc() {
        // implementation omitted
    }

    public function toBuffer($debug) {
        // implementation omitted
    }

    $arr = array_fill(0, 9000, null);

    for ($j = 0; $j < 40; $j++) {
        array_shift(array_keys($arr));
        array_fill(0, 64386, null);
    }
}
?>
</code>

?>