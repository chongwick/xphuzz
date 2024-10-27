<?php
  $fd = posix_ctermid();
  $buf = str_repeat(chr(0), PHP_INT_MAX);
  fwrite($fd, $buf);
?>
