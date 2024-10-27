<?php
session_start();
session_reset();
echo serialize(unserialize('O:8:"00000000":'));
?>
