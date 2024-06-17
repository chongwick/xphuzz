<?php

function opt() {
    (new class extends \stdClass {
        public function __construct() {
            try {
                $r = new \stdClass();
                $r->c = new \stdClass();
                $r->c->new = new \stdClass();
                $l = new \stdClass();
                $l->g = new \stdClass();
                $l->g->e = new \stdClass();
                $function = function () {
                };
                $functions = array($function); 
                $functions[] = $function; 
                $c = new \stdClass();
            } catch (\Exception $x) {
                throw $x;
            }
        }
    })();
}

try {
    opt();
} catch (\Exception $e) {
    echo "Exception thrown";
} catch (Throwable $t) {
    echo "No exception thrown";
}

?>
