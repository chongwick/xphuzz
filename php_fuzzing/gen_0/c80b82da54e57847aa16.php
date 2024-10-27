<?php
user_error(unserialize('O:8:"'. str_repeat('0', PHP_INT_MAX + 1). '":'), E_USER_ERROR);

?>