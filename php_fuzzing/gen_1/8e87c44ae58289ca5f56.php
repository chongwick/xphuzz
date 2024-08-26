<?php
require "/home/w023dtc/template.inc";


class MySessionHandler implements SessionHandlerInterface {
    public function open ($save_path, $session_name): bool {
        return true;
    }
    public function close(): bool {}
    public function read($id): string {
        return '';
    }
    public function write($id, $sess_data): bool {
        $a = array_fill(0, PHP_INT_MAX, (object) array('toString' => function() {
            throw new TestError();
        }));
        $b = (object) array('toString' => function() {
            throw new TestError();
        });
    }
    public function destroy($id): bool {}
    public function gc($maxlifetime): int {}
}

session_set_save_handler(new MySessionHandler());
session_start();

ob_start(function() {
    var_dump($b);
});

while (1) {
    $a[] = 1;
}

try {
    array_walk($a, function($value) {
        if ($value!== null) {
            throw new TestError();
        }
    });
    throw new AssertionError('Expected TestError to be thrown');
} catch (TestError $e) {}

?>
