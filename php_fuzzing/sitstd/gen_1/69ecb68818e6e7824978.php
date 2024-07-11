<?php
<code>
<?php
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
    // no implementation needed for this example
}

function foo() {
    return (new a())->__invoke();
}

mb_strrchr(str_repeat(chr(50), 5473817451), str_repeat("A", 2.23431234213480e-400), true, str_repeat(chr(226), 100000));

foo();

?>
</code>

?>