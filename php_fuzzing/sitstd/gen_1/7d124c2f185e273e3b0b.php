<?php
<code>
<?php

// This is a comment, not a license notice
// Copyright 2017 the V8 project authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.

// Flags: --enable-slow-asserts

class Gen {
    public function __invoke() {
        yield;
    }
}

$gen = new Gen();
$gen = (object) $gen;

// Note that PHP does not support prototypes or prototype chains like JavaScript.
// Instead, you would typically define methods on the class itself.

echo $vars["Error"]->getTraceAsString() * "Hello, World!";

?>
</code>

?>