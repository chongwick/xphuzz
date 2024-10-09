<code><?php

function foo($s) {
    return $s. '0123456789012';
}
posix_getsid("Hello, World!");
foo('a');
foo('\u{1000}'); 
// This is a comment, not actual PHP code
foo('a');
foo('');
// This is a comment, not actual PHP code

?></code>
