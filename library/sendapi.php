<?php

require '../bootstrap.php';
include './ApiClient.php';

use BurstAPI\ApiClient;

$errors = array();

$code = '404';
$errMsg = '';

$mobileno = isset($_POST['mobileno']) ? $_POST['mobileno'] : '';

$message = isset($_POST['message']) ? $_POST['message'] : '';

validateMobileno($mobileno, $errors);
validateMessage($message, $errors);

$msg = array();
if (count($errors) > 0) {
    foreach ($errors as $error) {
        $msg[] = '<div class="alert alert-warning">' . $error . '</div>' . "\r\n";
    }
} else {
    $smsResponses = sentSMS($message, $mobileno);
    $msgCounter = 1;
    foreach ($smsResponses as $smsResponse) {
        if ($smsResponse['message'] == 'OK') {
            $msg[] = '<div class="alert alert-success"> Message ' . $msgCounter . ' sent to ' . $mobileno . '</div>' . "\r\n";
        } else {
            $msg[] = '<div class="alert alert-warning"> Message ' . $msgCounter . ' was not sent. Err(' . $smsResponse['code'] . ') : ' . $smsResponse['message'] . '</div>' . "\r\n";
            // need to log error in error log
        }
        $msgCounter++;
    }
}

echo json_encode(['msg' => $msg]);


function sentSMS($message, $mobileNo) {
    $api_url = getenv('BURST_API_URL');
    $api_key = getenv('BURST_API_KEY');
    $api_secret = getenv('BURST_API_SECRET');

    $smsClient = new ApiClient($api_url, $api_key, $api_secret);

    $api_response = $smsClient->sendSMS($message, $mobileNo);

    return $api_response;
}

function validateMobileno($mobno, &$error) {
    switch (true) {
        case (strlen($mobno) == 0):
            $error[] = 'Mobile number is required.';
            break;
        case (strlen($mobno) != 10 && $mobno != '') :
            $error[] = 'Mobile number should be 10 characters.';
            break;
        case (!preg_match('/^(?:\+?61|0)[2-478](?:[ -]?[0-9]){8}$/', $mobno)):
            $error[] = 'Invalid mobile number.';
            break; // australian mobile number validation

        default : break;
    }
}

function validateMessage($msg, &$error) {
    switch (true) {
        case (strlen($msg) == 0):
            $error[] = 'Message cannot be empty';
            break;
        case (strlen($msg) > 480) :
            $error[] = 'Message cannot exceed 480 characters.'; // 3 sms length
            break;
        default : break;
    }
}
