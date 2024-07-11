<code><?php

function assertThrows($code, $expectedException) {
    try {
        eval($code);
    } catch (Exception $e) {
        if ($e instanceof $expectedException) {
            return true;
        }
    }
    return false;
}

strtr(str_split(str_shuffle(str_repeat(chr(91), 257). str_repeat(chr(236), 1025)), chr(91)), chr(236), chr(255));

if (!assertThrows('function fun($a = array("a" => 30)) { }', 'ParseError')) {
    echo "Test failed";
}

?></code>
