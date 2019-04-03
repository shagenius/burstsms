<?php

require 'bootstrap.php';

$client = new GuzzleHttp\Client([
    'proxy'=>'http://isadskw:Sham0419@osriproxy:3128',
    'auth'=>['76eaa9a89c1298566e1ce03afd4feec7','test'],
]);
$response = $client->request('GET', 'https://api.transmitsms.com/send-sms.json',
    [
        'query' => [
            'message' => "this is an another test 3",
            'to' => '61413206374'
        ]
    ]);

$resp = json_decode($response->getBody());
$resp_msg = '';

if($response->getStatusCode()==200) {
    $message_id = $resp->message_id;
}

$resp_msg = $resp->error->description;

echo $resp_msg;
