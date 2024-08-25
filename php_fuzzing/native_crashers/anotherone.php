<?php
class MySessionHandler implements SessionHandlerInterface {
    public function open ($save_path, $session_name): bool {
        return true;
    }
    public function close(): bool {}
    public function read($id): string {
        return '';
    }
    public function write($id, $sess_data): bool {
        ob_start(function () {});
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
?>
