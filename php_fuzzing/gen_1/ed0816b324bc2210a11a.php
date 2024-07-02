<?php
<code>
<?php
class Test {
    public function m() {
        for ($i = 0; $i < 30; $i++) {
            echo 'x ';
        }
        echo "\n";
        for ($i = 0; $i < 30; $i++) {
            echo 'x ';
        }
        echo "\n";
        for ($i = 0; $i < 30; $i++) {
            echo 'x ';
        }
        echo "\n";
        for ($i = 0; $i < 30; $i++) {
            echo 'x ';
        }
        echo "\n";
        for ($i = 0; $i < 30; $i++) {
            echo 'x ';
        }
        echo "\n";
        // Reference 201:
        echo 'x ';
        curl_setopt_array(fopen("https://example.com/non-existent-file.txt", "r"), array_merge(range(0, 10), array_fill(0, 100000, " invalid option")));
    }
}

$t = new Test();
$t->m();

?>
</code>

?>