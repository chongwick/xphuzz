<?php
<code>
<?php

class SuperClass {
    public function m() {
        return'm() method';
    }
}

class o1 {
    public function __invoke() {
        return (new SuperClass)->m();
    }
}

class o2 {
    public function __get($name) {
        return (new SuperClass)->m();
    }
}

class o3 {
    public $x = 1;
    public function m2() {
        (new SuperClass)->x;
    }
}

function foo($f) {
  return $f;
}

function bar($f) {
  $foo = new ReflectionFunction('foo');
  return $foo->invoke($f);
}

bar(function() {
    return 'Hello, World!';
});

$o1 = new o1();
echo $o1(); // outputs'm() method'

$o2 = new o2();
echo $o2->m(); // outputs'm() method'

$o3 = new o3();
echo $o3->m2(); // outputs'm() method'

?>
</code>

?>