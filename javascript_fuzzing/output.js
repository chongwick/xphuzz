// Check for special characters
if (!letter.match(/[!@#%&*]/)) {
  yield letter;
}

// Check for punctuation marks
if (!letter.match(/[.,:;?!]/)) {
  yield letter;
}

// Check for mathematical symbols
if (!letter.match(/[+\-*/=<>]/)) {
  yield letter;
}

// Check for whitespace characters
if (!letter.match(/\s/)) {
  yield letter;
}