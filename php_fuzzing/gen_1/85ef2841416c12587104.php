<?php
require "/home/w023dtc/template.inc";


class WasmModuleBuilder {
    //... other methods...

    public function makeSig($params, $results) {
        $x = PHP_INT_MAX;
        $foo = function() use (&$x) {
            return $x;
        };
        $x = PHP_INT_MIN;
        return "($params) => ($results)";
    }
}

?>
