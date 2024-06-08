<?php
// Copyright 2017 the V8 project authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.

function assertThrows($code, $expectedException) {
    try {
        eval($code);
        throw new AssertionError("Expected exception of type $expectedException, but no exception was thrown.");
    } catch (ParseError $e) {
        throw new $expectedException($e->getMessage());
    } catch (Error $e) {
        if (!($e instanceof $expectedException)) {
            throw new AssertionError("Expected exception of type $expectedException, but exception of type ". get_class($e). " was thrown.");
        }
    }
}

assertThrows("({ __proto__: null, __proto__: 1 });", 'Error');
?>
