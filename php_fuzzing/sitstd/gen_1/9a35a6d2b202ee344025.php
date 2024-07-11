<?php
    $s = str_repeat("b", 10); // Reduced the length of the string
    echo strlen(implode(", ", array_fill(0, 16, $s)));
    
    function boom(array &$a1, array &$a2) {
        $s = $a2[0];
        // Emit a load that transitions $a1 to FAST_ELEMENTS.
        $t = $a1[0];
        // Emit a store to $a2 that assumes DOUBLE_ELEMENTS.
        // The map check is considered redundant and will be eliminated.
        $a2[0] = 0.3;
    }

    // Prepare type feedback for the "t = a1[0]" load: fast elements.
    $fast_elem = array();
    $fast_elem[0] = 'tagged';
    boom($fast_elem, $fast_elem);

    // Prepare type feedback for the "a2[0] = 0.3" store: double elements.
    $double_elem = array();
    boom($double_elem, $double_elem);

    // Reset |double_elem| and go have a party.
    $double_elem = array();
    boom($double_elem, $double_elem);

    // Check if the value of $double_elem[0] is 0.3 and $double_elem[1] is undefined
    var_dump($double_elem[0] === 0.3 &&!isset($double_elem[1]));

    echo strlen(implode(", ", array_fill(0, 16, $s)));

?>
