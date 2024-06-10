<?php

function main() {
    $v2 = array();
    $v3 = array('hasOwnProperty' => $v2);
    function v5($v6, $v7, $v8, $v9, $v10) {
        $v14 = 'Intl\\NumberFormat';
        $v16 = $v14;
        $v18 = new $v16($v6, $v7, $v8, $v9, $v10);
        $v20 = get_class_methods('Boolean');
        $v22 = array(
            'preventExtensions' => 'eval',
            'get' => 'eval',
            'getPrototypeOf' => 'Object',
            'deleteProperty' => 'Boolean',
        'set' => 'Boolean',
            'getOwnPropertyDescriptor' => 'eval',
            'apply' => $v20,
            'has' => 'eval',
            'ownKeys' => 'Boolean',
        'setPrototypeOf' => 'eval',
            'call' => $v20,
            'isExtensible' => $v20,
            'defineProperty' => 'eval'
        );
        $v24 = new Proxy($v5, $v22);
        $v20 = get_class_methods('Boolean');
        $v20 = $v20;
        $v20 = $v24;
        return 100;
    }
    $v25 = array(
        'construct' => 'Boolean',
        'call' => 'Boolean',
        'apply' => $v5,
    'setPrototypeOf' => $v5,
        'isExtensible' => $v5,
        'getPrototypeOf' => $v5,
        'ownKeys' => 'Boolean',
        'preventExtensions' => 'Boolean'
    );
    $v27 = new Proxy($v3, $v25);
    $v20 = get_class_methods('Boolean');
    $v20 = $v20;
    $v20 = $v27;
    $v29 = array();
    $v31 = array();
    $v33 = array();
    $v34 = array('hasOwnProperty' => $v33);
    function v36($v37, $v38, $v39,
