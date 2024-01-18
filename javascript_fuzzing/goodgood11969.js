boom0 = (function(stdlib, foreign, heap){
  "use asm";
  var ff = Math.sign;
  var m32 = new stdlib.Int32Array(heap);
  function f(v) {
    arr=[];
    for (var i = 0; i < 100000; i++)
        arr[i] = [];
    arr.indexOf(new Object(), {valueOf:function(){arr.length = 0}});
    m32[((1-ff(NaN) >>> 0) % 0xdc4e153) & v] = 0x12345678;
  }
  return f;
})(this, {}, new ArrayBuffer(256));
%OptimizeFunctionOnNextCall(boom0);
boom0(0xffffffff);
