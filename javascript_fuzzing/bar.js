var assert = require('assert');


var buffer = new ArrayBuffer(64);
var view = new DataView(buffer);
view.setInt8(0,0x80);
assert(view.getInt8(-1770523502845470856) === -0x80);
