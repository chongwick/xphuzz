<?php
<code>
<?php

function main() {
    function v1($v2, $v3, $v4, $v5) {
        $func = $v4;
        $func($v2, $v3, $v5);
    }
    function v4($v1, $v2, $v3) {
        gzseek(gzopen("non_existent_file.txt", "rb"), 3, pow(-1, 2.23431234213480e-400) * 123475932);
        // your code here
    }
    v1('v2', 'v3', 'v4', 'v5');
}

main();

?>
</code>

?>