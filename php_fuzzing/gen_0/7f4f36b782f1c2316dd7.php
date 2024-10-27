<?php
class MyException extends Exception {}
try {
    throw new MyException;
} catch (Exception $e) {
    $e->getPrevious();
}
?>
