<?php

/*
 * Library Name: qGraph API Integration
 * Description:  This library helps developer to connect qGraph APi for managing sending push notification on different devices.
 * Author: KumarShyama
 * Version: 1.0
 */
error_reporting(E_ERROR | E_WARNING | E_PARSE);
error_reporting(E_ALL);
ini_set("error_reporting", E_ALL);
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', '1');

include(dirname(__FILE__) . '/configuration.php');

class qGraphAPI {
    /* The API Key, Secret, & URL will be used in every function. */

    private $api_key = Token;
    //private $api_secret = API_SECRET;
    private $api_url = API_URL;

    // Function to send HTTP POST Requests Used by every function below to make HTTP POST call

    function sendRequest($calledFunction, $data) {
        /* Creates the endpoint URL */
        $request_url = $this->api_url . $calledFunction.'/';

        //$postFields = http_build_query($data);
        /* Check to see queried fields */
        /* Used for troubleshooting/debugging */
        $postFields =  json_encode($data);
//        echo $request_url.'-----'.$this->api_key;
//        echo $postFields;
        /* Preparing Query... */
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Token: $this->api_key $request_url"
        ));
        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        //echo $response;
        /* Check for any errors */
                
        curl_close($ch);
        if (!$response) {
            return false;
        }
        /* Return the data in JSON format */
        return $response;
    }

    function sendNotification($campaign_id = '14517', $segment_id='6973', $os_type='android', $message) {
        $resArray = array();
        $resArray['cid'] = $campaign_id;
        $resArray['segment_id'] = $segment_id; 
        $resArray['os'] = $os_type; 
        $resArray['message'] = $message;
        return $this->sendRequest('send-notification', $resArray);
    }

}
?> 