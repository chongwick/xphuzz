<?php
 PHP_INT_MAX - 1
 PHP_INT_MIN + 1
 PHP_FLOAT_MAX * -1
 PHP_FLOAT_MIN * -1

 NULL === (array) PHP_INT_MAX
 NULL === (array) PHP_INT_MIN
 NULL === (array) PHP_FLOAT_MAX
 NULL === (array) PHP_FLOAT_MIN

 var_dump(unserialize('O:'.PHP_INT_MAX.':'));
 var_dump(unserialize('O:'.PHP_INT_MIN.':'));
 var_dump(unserialize('O:'.PHP_FLOAT_MAX.':'));
 var_dump(unserialize('O:'.PHP_FLOAT_MIN.':'));

?>