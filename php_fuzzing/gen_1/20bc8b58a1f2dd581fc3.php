<?php
<code>
<?php
for ($i = 0; $i < 5000; $i++) {
    try {
        new Ctor();
        array_reduce(array(), function() {});
    } catch (Exception $x) {
        new Check();
    }
}
?>
</code>

?>