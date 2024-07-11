<?php

function f($a, $b) {
  for ($i = 0; $i < 100000; $i++) {
    $c = $a + 2 + $i + 5;
    $d = $c + 3;
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
}

for ($j = 0; $j < 3; $j++) {
  f(2, 3);
}

try {
    opt();
} catch (\Exception $e) {
    echo "Exception thrown";
} catch (Throwable $t) {
    echo "No exception thrown";
}

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

?>
