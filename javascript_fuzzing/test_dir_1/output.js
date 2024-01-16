function opt(arr, start, end) {
        for (let i = start; i < end; i++) {
                if (i === 10) {
                        i += 0;
                }
                arr[i] = 2.3023e-320;
        }
}
function main() {
        let arr = new Array(100);
        arr.fill(1.1);

        for (let i = 0; i < 1000; i++) {
                opt(arr, 0, 3);
        }
        opt(arr, 0, 100000);
}
const startTime = Date.now();
const endTime = startTime + 1000; // Set the end time to 1 second after the start time

while (Date.now() < endTime) {} // Loop for 1 second to simulate a long-running task

console.log("Finished waiting for 1 second");

main();


