<?php
function foo() {
    return new ReflectionFunction('foo');
}
foo()->invoke();

?>