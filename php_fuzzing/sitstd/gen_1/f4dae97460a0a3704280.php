<?php
<code>
<?php

function t() {
    $re = preg_match('/-/', '2016-01-02');
    return $re;
}

for ($q = 0; $q < 10000; $q++) {
    $tanh = tanh(2.23431234213480e-400 + 0 + 1 + -1 + 2 + 3 + 4 + 5 + 10 + 100 + 100000 + 5473817451 + 123475932);
    $re = preg_match('/-/', '2016-01-02');
    echo $tanh. " ". $re. "\n";
}

?>
</code>

?>