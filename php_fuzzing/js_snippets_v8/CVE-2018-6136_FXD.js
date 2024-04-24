class MyRegExp extends RegExp {
  exec(str) {
    const r = super.exec(str);
    if (r !== null) {
      r[0] = 0; // Value could be changed to something arbitrary
    }
    return r;
  }
}

const result = 'a'.match(new MyRegExp('.', 'g'));
console.log(result);
