<?php

class Offsets {
    private $offsets_obj;

    public function __construct() {
        $this->offsets_obj = array(
            'JS_GLOBAL_OBJ_TO_GLOBAL_OBJ' => null,
            'GLOBAL_OBJ_TO_VM' => null,
            'VM_TO_TOP_CALL_FRAME' => null,
            'JS_FUNCTION_TO_EXECUTABLE' => null,
            'EXECUTABLE_TO_JITCODE' => null,
            'EXECUTABLE_TO_NATIVE_FUNC' => null,
            'JIT_CODE_TO_ENTRYPOINT' => null,
            'JSC_BASE_TO_SEGV_HANDLER' => null,
            'JSC_BASE_TO_CATCH_EXCEPTION_RET_ADDR' => null,
            'JSC_BASE_TO_MATH_EXP' => null,
        );

        $this->resolve();
    }

    private function resolve() {
        if (defined('IN_BROWSER')) {
            if (strpos($_SERVER['HTTP_USER_AGENT'], 'Intel Mac OS X 10_15_4')!== false) {
                $this->offsets_obj['JS_GLOBAL_OBJ_TO_GLOBAL_OBJ'] = 24;
                $this->offsets_obj['GLOBAL_OBJ_TO_VM'] = 56;
                $thisassistant

The issue is that the code is missing a closing `}` at the end of the line. Here is the corrected code:

