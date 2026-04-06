<?php
// Copyright 2015 the V8 project authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.

// No equivalent flags in PHP, but you can use the following to debug:
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// No equivalent to %DebugGetLoadedScripts() in PHP, but you can use the following to get loaded scripts:
$loaded_scripts = get_loaded_extensions();
print_r($loaded_scripts);
?>
