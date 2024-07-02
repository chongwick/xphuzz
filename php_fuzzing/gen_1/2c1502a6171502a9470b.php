<?php
<code>
<?php

function assertThrows(callable $callback, $expectedException) {
    try {
        $callback();
        throw new Exception("Expected exception of type $expectedException, but no exception was thrown");
    } catch (TypeError $e) {
        return;
    } catch (Exception $e) {
        throw new Exception("Expected exception of type $expectedException, but got $e");
    }
}

assertThrows(function() { max(2, (bool) 'hello world' ^ (int) 'abc'); }, 'TypeError');

?>
</code>

?>