<?php
// Copyright 2016 the V8 project authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.

// No equivalent for JavaScript flags in PHP, so commenting this out
// --allow-natives-syntax

class Symbol {
    public function symbol() {
        echo "Symbol called\n";
    }
}

$v = new Symbol();

function f($v) {
    for ($i = 0; $i < 2; $i++) {
        try {
            $v->symbol();
        } catch (Exception $e) {}
    }
}

function GetScript() {
    // No equivalent for JavaScript's %FunctionGetScript in PHP
    // Returning an empty array as a placeholder
    return array();
}

function GetSourceCode() {
    // No equivalent for JavaScript's %FunctionGetSourceCode in PHP
    // Returning an empty string as a placeholder
    return '';
}

f($v);

?>
