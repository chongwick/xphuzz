<?php
ini_set('memory_limit', '512M'); // adjust the value as needed
$r2 = '/(?=)*$/';
$s0 = str_repeat('a', 220000700); // the size could be different
$result = preg_match_all($r2, $s0, $matches);

// Simulating AudioContext
function getAudioContext() {
    return array('sampleRate' => 44100, 'bufferSize' => 16384);
}

// Simulating listener
function getListener() {
    return array('x' => 0, 'y' => 0, 'z' => 0);
}

// Simulating document.addEventListener
function addEventListener($event, $callback) {
    if ($event == '0') { // Assuming '0' is a valid event type in PHP
        $callback(getAudioContext(), getListener());
    }
}

// Using the simulated functions
addEventListener('0', function($audioContext, $listener) {
    echo "AudioContext: ". json_encode($audioContext). "<br>";
    echo "Listener: ". json_encode($listener). "<br>";
    echo "preg_match_all result: ". $result. "<br>";
    echo "preg_match_all matches: ". json_encode($matches). "<br>";
});

?>
