<?php
iconv_strpos(iconv('UTF-8', 'ISO-8859-1', ''), chr(0x10FFFF));

?>