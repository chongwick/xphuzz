function assertEquals(expected, actual) {
  if (expected !== actual) {
    throw new Error(`Assertion failed: Expected ${expected}, but found ${actual}`);
  }
}

function foo(trigger) {
  return (trigger ? -0 : 0) - 0;
}

assertEquals(0, foo(false));
%OptimizeFunctionOnNextCall(foo);
assertEquals(-0, foo(true));
