const invalidControls = function* () {
  // Check upper case Cyrillic
  for (let alpha = 0x0410; alpha <= 0x042F; alpha++) {
    yield String.fromCharCode(alpha);
  }

  // Check lower case Cyrillic
  for (let alpha = 0x0430; alpha <= 0x044F; alpha++) {
    yield String.fromCharCode(alpha);
  }

  // Check ASCII characters which are not in the extended range or syntax
  // characters
  for (let alpha = 0x00; alpha <= 0x7F; alpha++) {
    let letter = String.fromCharCode(alpha);
    if (!letter.match(/[0-9A-Za-z_\$(|)\[\]\/\\^]/)) {
      yield letter;
    }
  }

  // Check for end of string
  yield "";
};

const generator = invalidControls();
let result = generator.next();
while (!result.done) {
  console.log(result.value);
  result = generator.next();
}

const values = Array.from(invalidControls());
console.log(values);

const filteredValues = values.filter(
  (value) =>
    value !== "$" &&
    value !== "(" &&
    value !== ")" &&
    value !== "[" &&
    value !== "]" &&
    value !== "/" &&
    value !== "\\" &&
    value !== "^"
);
console.log(filteredValues);

const sortedValues = filteredValues.sort((a, b) => {
  if (a < b) {
    return 1;
  }
  if (a > b) {
    return -1;
  }
  return 0;
});
console.log(sortedValues);
