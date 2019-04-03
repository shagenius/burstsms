<?php

namespace BurstAPI;
require '../bootstrap.php';

/**
 * Description of ApiClient
 *
 * @author Shameemah Kurzawa <shameemah@gmail.com>
 */
class ApiClient {
    
    private $client;
    private $api_url;


    public function __construct($api_url, $api_key, $api_secret) {    
        $this->api_url = $api_url;
        $this->client = new \GuzzleHttp\Client([
            'auth'=>[$api_key, $api_secret],
        ]);
    }
    
    public function sendSMS($message, $mobileno) {
        //split the message in chunks of 160 characters (1 sms)
        $messages = str_split($message, 160);
        
        //add country code (61) and drop the 0 
        $mobileno = '61' . substr($mobileno, 1); // eg australian country code
        
        $smsResponse = array();
        
        foreach ($messages as $msg ){
            $response = $this->client->get($this->api_url.'/send-sms.json', [
                'query' => [
                    'message' => $msg,
                    'to' => $mobileno
                ],
            ]);
        
            $result = json_decode($response->getBody());
            
            $smsResponse[] = array(
                'code' => $response->getStatusCode(),
                'message' => $result->error->description
            );
        }
        return $smsResponse;
    }
            
}
