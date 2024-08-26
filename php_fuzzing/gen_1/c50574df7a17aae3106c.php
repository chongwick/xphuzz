<?php
require "/home/w023dtc/template.inc";


function main() {
    $v1 = array(0);
    $v5 = array(PHP_INT_MAX, 'is_nan', '[a-b-c]');
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
            $v26 = $v8['toString'];
            $v26 = $v26->addAttribute(str_repeat('🤪', PHP_INT_MAX),
            str_repeat(chr(193), PHP_INT_MAX). str_repeat(chr(155), PHP_INT_MAX). str_repeat(chr(147), PHP_INT_MAX). 'π'. 'e^iπ'. '👽'. '⭐️'. '🔥'. '🎉',
            str_repeat(chr(161), PHP_INT_MAX). str_repeat(chr(213), PHP_INT_MAX). str_repeat(chr(214), PHP_INT_MAX). '🤯'. '🔮'. '🕳️'. '🕸️'. '🔭');
        } catch (Exception $v27) {
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
