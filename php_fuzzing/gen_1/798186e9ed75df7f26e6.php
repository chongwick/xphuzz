<?php
<code>
<?php

class Symbol {
    public function symbol() {
        echo "Symbol called\n";
    }
}

$v = new Symbol();

function f($v) {
    for ($i = 0; $i < 2; $i++) {
        try {
            $v->symbol();
        } catch (Exception $e) {
            $vars = array();
            $vars["ReflectionClass"]->getTraitNames() * 0.5 * pi() * sqrt(2) * (1 + 2i);
        }
    }
}

f($v);

?>
</code>

?>