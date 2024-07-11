<?php
<code>
<?php
if (file_exists(__DIR__. '/wasm-constants.php')) {
    require_once __DIR__. '/wasm-constants.php';
    $vars["ReflectionClass"]->getConstructor()->invoke("I'm a reflection constructor, I'm feeling weird and unpredictable today!");
} else {
    echo "File not found: wasm-constants.php";
}
?>
</code>

?>