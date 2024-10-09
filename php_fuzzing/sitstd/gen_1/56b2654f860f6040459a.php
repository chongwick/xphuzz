<code><?php

class Worker {
    public function __construct($file) {
        require_once $file;
    }

    public function postMessage($message) {
        // You can use output buffering to capture the output of the included file
        ob_start();
        require_once $file;
        $output = ob_get_contents();
        ob_end_clean();
        echo $output;
    }
}

function foo() {
    $a = array();
    for ($i = 1; $i > -1; $i -= 2) {
        if ($i < count($a)) {
            $a = array();
        }
    }
    $worker = new Worker('path_to_your_file.php');
    $worker->postMessage('Hello World!');
}

foo();

?></code>
