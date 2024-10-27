<?php
class MyException extends Exception {}
try {
    throw new MyException;
} catch (MyException $e) {
    $e->getMessage();
}
