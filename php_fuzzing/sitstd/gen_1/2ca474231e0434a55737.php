<?php
function myLog($message) {
    echo $message. "\n";
    xmlwriter_end_comment(pow(2, 32) * (rand() % 10000));
}

?>
