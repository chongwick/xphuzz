const acorn = require("acorn");
const fs = require("fs");

// process.argv[0] is 'node'
// process.argv[1] is 'js2ast.js'
// process.argv[2] is the filename you provide
const filePath = process.argv[2];

if (!filePath) {
  console.error("Please provide a file path: node js2ast.js <filename.js>");
  process.exit(1);
}

try {
  // Read the content of the JS file
  const code = fs.readFileSync(filePath, "utf8");

  // Parse the code into an AST
  const ast = acorn.parse(code, { 
    ecmaVersion: 2020,
    sourceType: "module" 
  });
  //fs.writeFileSync("ast.json", JSON.stringify(ast, null, 2));

  //// Output the AST as a stringified JSON
  console.log(JSON.stringify(ast, null, 2));

} catch (err) {
  console.error("Error reading or parsing file:", err.message);
  process.exit(1);
}
