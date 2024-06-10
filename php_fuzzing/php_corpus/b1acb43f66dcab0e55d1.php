<?php

class Foo {
    public function f() {
        $o = array(
            'a' => array(),
            'b' => array(
                'ba' => array(
                    'baa' => 0,
                    'bab' => array()
                ),
                'bb' => array(),
                'bc' => array(
                    'bca' => array(
                        'bcaa' => 0,
                        'bcab' => 0,
                        'bcac' => $this
                    )
                )
            )
        );
        $o['b']['bc']['bca']['bcab'] = 0;
        $o['b']['bb']['bba'] = array_values($o['b']['ba']['bab']);
    }
}

$foo = new Foo();
while (true) {
    $foo->f($foo);
}

?>
