<code><?php

class AsyncGenerator {
    public function __invoke() {
        // Your generator logic here
    }
}

class This {
    public function __set($name, $value) {
        $this->$name = $value;
    }
}

function go($y = array(), $b = '') {
    // The position of "AAAA" controls a register value.
    if (count($y) > 0 && count($y) == count($y[0])) {
        $b = "CCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCAAAA";
    }
    if (count($y) < 10) {
        $y[] = array(); // Add an element to the array
        go($y, $b);
    }
}

$gen = new AsyncGenerator();
$gen->then = function () use ($gen) {
    unset($gen->then);
    $gen->next();
};

$go = new This();
go(array(), '');
$go->x;

$gen->then = function () use ($go) {
    $go->y = 'hello';
    $go->then = function () use ($go) {
        echo $go->y;
    };
};

$gen->then();

?></code>
