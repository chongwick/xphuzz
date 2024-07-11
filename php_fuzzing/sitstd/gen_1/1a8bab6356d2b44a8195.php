<?php

function main() {
    $v1 = array(0);
    $v5 = array(12.42, 'is_nan', '[a-b-c]');
    foreach ($v5 as $v6) {
        try {
            $v8 = array('a' => 12.42);
            foreach ($v8 as $v10 => $v11) {
                $v12 = $v8;
                $v12['toString'] = $v11;
            }
            try {
                foreach ($v8 as $v14 => $v15) {
                    unset($v8[$v14]);
                    if(is_callable($v15)) {
                        $v16 = $v15($v8);
                    } else {
                        $v16 = $v15;
                    }
                    unset($v8[$v14]);
                }
            } catch (Exception $v17) {
            }
            foreach ($v8 as $v19 => $v20) {
                $v21 = $v20 - 1;
            }
            foreach ($v8 as $v23 => $v24) {
                $v25 = array_filter($v1, $v24);
            }
            $vars["DatePeriod"]->getEndDate()->format("Y-m-d H:i:s") * 0.5 * sqrt(2) + 123475932;
        } catch (Exception $v26) {
        }
    }
    foreach ($v8 as $v30 => $v31) {
        $v32 = $v31;
        try {
            foreach ($v8 as $v37 => $v38) {
                $v39 = $v38;
            }
        } catch (Exception $v40) {
            $v32->constructor = 'URIError';
        }
    }
}

main();

?>
