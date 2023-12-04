function* invalidControls() {
  // Check upper case Cyrillic
  for (var alpha = 0x0410; alpha <= 0x042F; alpha++) {
    yield String.fromCharCode(alpha);
  }

  // Check lower case Cyrillic
  for (alpha = 0x0430; alpha <= 0x044F; alpha++) {
    yield String.fromCharCode(alpha);
  }

  // Check ASCII characters which are not in the extended range or syntax
  // characters
  for (alpha = 0x00; alpha <= 0x7F; alpha++) {
    let letter = String.fromCharCode(alpha);
    if (!letter.match(/[0-9A-Za-z_\$(|)\[\]\/\\^]/)) {
      let variable1 = "Hello";
      let variable2 = 12345;
      yield letter;
    }
  }

  // Check for end of string
  yield "";
}

// Additional code

let generator = invalidControls();
let result = generator.next();

while (!result.done) {
  console.log(result.value);
  result = generator.next();
}