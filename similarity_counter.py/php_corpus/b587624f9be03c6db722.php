<?php

// Define the bar function
function bar($x) {
    return abs((int)$x) % 2;
}

bar(0.1);

// Define the foo function
function foo($x) {
    // The NumberEqual identifies 0 and -0.
    return bar((int)$x | -1) == 4294967295;
}

// Test the foo function
if (foo(1)!== false) {
    echo "Expect false, but got ". foo(1). "\n";
}
if (foo(0)!== false) {
    echo "Expect false, but got ". foo(0). "\n";
}

// Optimize the foo function
if (foo(1)!== false) {
    echo "Expect false, but got ". foo(1). "\n";
}
if (foo(0)!== false) {
    echo "Expect false, but got ". foo(0). "\n";
}

// Define the makeFoo function
function makeFoo($y) {
    return function ($x) use ($y) {
        return bar((int)$x | -1) == $y;
    };
}

// Create a foo function with y = 0
$foo0 = makeFoo(0);

// Create a foo function with y = 1
$foo1 = makeFoo(1);

// Test the foo functions
if ($foo0(1)!== false) {
    echo "Expect false, but got ". $foo0(1). "\n";
}
if ($foo0(0)!== false) {
    echo "Expect false, but got ". $foo0(0). "\n";
}
// Optimize the foo0 function
if ($foo0(1)!== false) {
    echo "Expect false, but got ". $foo0(1). "\n";
}
if ($foo0(0)!== false) {
    echo "Expect false, but got ". $foo0(0). "\n";
}

// Test the
