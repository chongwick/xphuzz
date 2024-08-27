<?php
(function() {
    // Filename construction, hidden inside an IIFE
    $filename = implode('/', [__DIR__, pathinfo(__FILE__, PATHINFO_FILENAME) . '.phar.zip']);
    
    // Phar object instantiation
    $pharObject = (new class($filename) {
        public $phar;
        public function __construct($fname) {
            $this->phar = new Phar($fname);
        }
    })->phar;
    
    // Initiating global storage
    $globalStorage = (function() use ($pharObject) {
        $storage = new SplObjectStorage();
        $storage[$pharObject] = new class {
            public function __destruct() {
                // Nested within another anonymous class
                (function() {
                    var_dump($GLOBALS['globalConnector']);
                })();
            }
        };
        return $storage;
    })();
    
    // Making the storage globally accessible in an unconventional manner
    $GLOBALS['globalConnector'] = &$globalStorage;
})();
?>

