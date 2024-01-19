var foo = (function(stdlib, foreign, heap) {
  "use asm";
  var MEM = new stdlib.Uint8Array(heap);
  var boom = (function(stdlib, foreign, heap) {
    "use asm";
    var Uint8ArrayView = new stdlib.Uint8Array(heap);
    var Int32ArrayView = new stdlib.Int32Array(heap);
    function f(i, i1) {
      i1 = Uint8ArrayView[256];
      // This following value '10' determines the value of 'rax'
      Int32ArrayView[i1 >> 10] = 0xabcdefaa;
      return -i1 + Int32ArrayView[i1 >> 2];
    }
    return f;
  })(stdlib, foreign, heap);
  
  function foo(x) {
    MEM[x | 0] *= 0;
    return boom(0, 0x1000);
  }
  
  return { foo: foo };
})(this, {}, new ArrayBuffer(1)).foo;

foo(-926416896 * 8 * 1024);
