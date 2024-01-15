function opt(arr, start, end) {
        for (let i = start; i < end; i++) {
                if (i === 10) {
                        i += 0;
                }
                arr[i] = 2.3023e-320;
        }
}
function main() {
let startTime = Date.now();
let endTime;
let elapsedTime;

let iterations = 0;
let maxIterations = 1000000;

while (iterations < maxIterations) {
    iterations++;
    if (iterations % 1000 === 0) {
        endTime = Date.now();
        elapsedTime = endTime - startTime;
        if (elapsedTime > 1000) {
            break;
        }
    }
}

        let arr = new Array(100);
        arr.fill(1.1);

        for (let i = 0; i < 1000; i++) {
                opt(arr, 0, 3);
        }
        opt(arr, 0, 100000);
}
main();


