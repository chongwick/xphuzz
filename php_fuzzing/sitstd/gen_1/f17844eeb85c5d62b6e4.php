<code><?php

function assertThrows($code, $expectedException) {
    try {
        eval($code);
    } catch (Throwable $e) {
        if (!($e instanceof $expectedException)) {
            throw $e;
        }
    }
}

assertThrows("function a() { return ReflectionParameter::class; } echo (a() == ReflectionParameter::class);", "ParseError");

$vars["ReflectionParameter"]->canBePassedByValue()->getDeclaringClass()->getNamespaceName()->getFileName()->getBasename()->getExtension()->getShortName()->getDocComment()->get();

?></code>
