<?php
<code>
<?php
function call_f() {
    global $mod; 
    $i = 0;
    while ($i < 1000) { 
        $mod['f'](atan2(1,0)/atan2(0,1)^atan2(1,1));
        $i++;
    }
}

?>
</code>

?>