<?php
<code>
<?php

function assertThrows($code, $expectedException) {
    try {
        eval($code);
    } catch (ParseError $e) {
        return;
    }
    trigger_error('Custom error message', E_ERROR);
    throw new AssertionError('Expected a ParseError, but no exception was thrown');
}

assertThrows('xmlwriter_end_document(fopen("https://example.com/non-existent-file.txt", "w"));', 'ParseError');

?>
</code>

?>