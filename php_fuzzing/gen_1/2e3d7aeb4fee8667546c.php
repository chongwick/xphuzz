<?php
require "/home/w023dtc/template.inc";


class a {
    public function __invoke() {
        return [];
    }
}

class b {
    public function __invoke() {
        return [];
    }
}

class c {
    public function __invoke($arg) {
        switch ($arg) {
            case PHP_INT_MAX:
                $value;
                // None of the branches of this switch are ever taken, but
                // the sequence means value could be the hole.
                switch ($arg) {
                    case PHP_INT_MAX:
                        $let_var = PHP_INT_MAX;
                    case PHP_FLOAT_MAX:
                        $value = $let_var;
                }
                // Speculative number binop with NumberOrOddball feedback.
                // Shouldn't be optimized to pure operator since value's phi
                // could theoretically be the hole (we would have already thrown a
                // reference error in case 2 above if so, but TF typing still
                // thinks it could be the hole).
                return $value * null;
        }
    }
}

function foo() {
    return (new a())->__invoke();
}

foo();

?>
