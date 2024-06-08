<?php

function gc() {
    for ($i = 0; $i < 200; $i++) {
        // equivalent to new ArrayBuffer(0x100000);
    }
}

function throwException() {
    throw new Exception(1);
}

function start() {
    $mem = array(); // Replace SplMemoryObject with an empty array
    $arr = [$mem];
    try {
        $arr[1] = throwException; // Use the function directly
    } catch (Exception $e) {
        // $mem->grow(1); // This line is commented out as it's not a standard PHP method
        // $worker->terminate();
        gc();
        // $dv = new SplDataView($mem->getBuffer()); // This line is commented out as it's not a standard PHP method
        // $dv->setUint8(0, 0);            // will trigger segment fault
    }
    $blob = new SplFileInfo('worker1', 'text/javascript', 'dummy content'); // Replace file_get_contents with a hardcoded string
    $worker = new SplWorker(new SplURL('blob:'. $blob->getPathname()));

    $worker->onMessage = function($e) {
        echo "Received: ". $e->getData(). "\n";
    };
    try {
        $worker->postMessage($arr); 
    } catch (Exception $e) {
        // $mem->grow(1); // This line is commented out as it's not a standard PHP method
        // $worker->terminate();
        gc();
        // $dv = new SplDataView($mem->getBuffer()); // This line is commented out as it's not a standard PHP method
        // $dv->setUint8
