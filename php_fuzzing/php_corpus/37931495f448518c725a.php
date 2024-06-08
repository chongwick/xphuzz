<?php

function E($b) {
    while (true) {
        for (; $b; ) {
            // yield is not a native PHP construct, so we'll use a workaround
            // to achieve the same effect
            $b = false;
        }
    }
}

E(true);

?>
