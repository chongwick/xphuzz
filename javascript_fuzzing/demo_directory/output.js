var array = [];
var funky = {
  toJSON: function() { array.length = 1; return "funky"; }
};
for (var i = 0; i < 10; i++) array[i] = i;
array[0] = funky;

class MyRegExp extends RegExp {
  exec(str) {
    const r = super.exec.call(this, str);
    if (r) r.length=0;
    return r;
  }
}

const result = 'a'.match(new MyRegExp('.', 'g'));
var crash = result[0].x;

JSON.stringify(array);
