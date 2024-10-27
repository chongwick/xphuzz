<?php

class MyException extends Exception {}

try {
    throw new MyException();
} catch (Exception $e) {
    echo "Caught Exception";
} catch (MyException $e) {
    echo "Caught MyException";
}

?>
