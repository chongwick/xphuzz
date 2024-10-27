<?php
$phar = new Phar('test.phar');
$phar->startBuffering();
$phar->addFromString('test.txt', 'Hello');
$phar->stopBuffering();
$phar->setStub('<?php __HALT_COMPILER();?>');

?>