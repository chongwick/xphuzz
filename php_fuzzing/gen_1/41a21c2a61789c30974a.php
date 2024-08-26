<?php
require "/home/w023dtc/template.inc";


for ($i = PHP_INT_MAX; $i >= 0; $i--) {
    $stdClass = new stdClass();
    $stdClass->{"0"} = $i;
}

function assertThrows($callback) {
    try {
        $callback();
        echo "Test failed";
    } catch (Exception $e) {
        echo "Test passed";
    }
}

assertThrows(function() {
    unserialized(base64_decode("Tzo5OiJFeGNlcHRpb24iOjc5OTk5OTk5OTk5OTk5OTk5OTk5OTk5OTk5OTk5OTk5OTk5Nzp7aTowO2E6MDp7fWk6NjA7ZDozMDAwMDAwMDAwNjE3MDAyOTU3OUUtMTE4O2k6MjtkOjAwMDMxO2k6MjtkOis5NTcxMzMzMzAwMEUtMDAwMDM1ODtpOjI7ZDo0OTU3MTExRS0wMDAwMzE4O2k6MDYyO2k6MTtpOjA7UjoyO2k6")));
});

?>

