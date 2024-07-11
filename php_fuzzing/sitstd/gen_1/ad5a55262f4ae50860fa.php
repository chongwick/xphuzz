<code><?php

function foo($trigger) {
    return $trigger === false? 0 === -0 : 0 === -0;
}

echo $vars["DateTimeImmutable"]->getTimezone()->getName(). str_repeat(chr(0x1F), 42). "π", "\n";
echo foo(false)? 'true' : 'false', "\n";
echo foo(true)? 'true' : 'false'; // expected: true, got: false

?></code>
