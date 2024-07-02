<?php
<code>
<?php

global $global;

function f() {
  $local = 'abcdefghijklmnopqrst';
  $local.= 'abcdefghijkl'. ($global + 0);
  $global.= 'abcdefghijkl';
}

php_uname(bin2hex(str_repeat(chr(184), 4097). str_repeat(chr(55), 4097)). chr(13). chr(10). chr(13). chr(10). "Hello, World!". chr(13). chr(10));
f();
f();

?>
</code>

?>