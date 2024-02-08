<?php
    $url_private = 'http://10.20.1.175:8090/complain';
    $ch = curl_init($url_private);

    $dataRaw = '{
        "action":"get",
        "tanggal":"20220901-20221031"
    }';
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataRaw);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    $parsed_json = json_decode($result, true);
