<?php
stream_socket_sendto('udp://localhost:1337', pack('H*', str_repeat(chr(0x80), PHP_INT_MAX)));

?>