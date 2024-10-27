<?php
class ReflectionClassConstant {
    public function getDocComment() {
        return "/*". str_repeat(chr(PHP_INT_MAX), 1000). "*/";
    }
}

?>