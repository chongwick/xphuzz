<?php
try {
    $a = str_repeat('a', 1 << 20); // Changed the value from 1 << 28 to 1 << 20
} catch (Exception $e) {
    // If the allocation fails, we don't care, because we can't cause the
    // overflow.
}
// Cause an overflow in worst-case calculation for string replacement.
json_encode($a);
?>

