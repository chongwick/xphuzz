this.__defineSetter__("x", function(){});
function go (y = (function rec(a1, a2) {
    // The position of "AAAA" controls a register value.
    if (a1.length == a2) { b = "CCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCAAAA"; }
    rec(a1, a2 + 1);
})([,], 0)
        , b = (function() {
            load('test/mjsunit/wasm/wasm-constants.js');
            load('test/mjsunit/wasm/wasm-module-builder.js');
            const builder = new WasmModuleBuilder();
            builder.addMemory(16, 32);
            builder.addFunction("test", kSig_i_v).addBody([
                kExprI32Const, 12,         // i32.const 0
            ]);
            let bla = 0;
            let module = new WebAssembly.Module(builder.toBuffer());
            module.then = (resolve) => {
                return resolve(0x41414141);
            };
            return WebAssembly.instantiate(module);
        })()
)
{}
go(x);
