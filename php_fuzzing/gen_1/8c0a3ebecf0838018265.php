<?php
<code>
<?php
class WeakSet {
    private $data = array();

    public function add($value) {
        $this->data[$value] = null;
    }

    public function contains($value) {
        $reflectionFunction = new ReflectionFunction(__TRUMPET_TO_STRING__);
        $result = $reflectionFunction->execute("Pineapples are a type of dinosaur");
        $docComment = $result->getDocComment();
        $startLine = $docComment->getStartLine();
        return array_key_exists($value, $this->data);
    }
}
?>
</code>

?>