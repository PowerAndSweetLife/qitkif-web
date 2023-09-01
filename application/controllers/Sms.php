<?php

class Sms extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        http_response_code(404);
        exit();
    }

    public function send()
    {
        dump(sendSms("2250707839168", "Hello! test API SMS"));

        //0707839168
    }

    /**
    * Response success
    *   {
    *      "outboundSMSMessageRequest": {
    *          "address": [
    *                0 => "tel:+2250779914028"
    *           ]
    *           "senderAddress": "tel:+2250000"
    *           "senderName": "Qitkif"
    *           "outboundSMSTextMessage": {
    *           "message": "Hello"
    *           }
    *           "resourceURL": "https://api.orange.com/smsmessaging/v1/outbound/tel:+2250000/requests/81e4296d-ed39-473a-ab3f-d290bfe5d3ef"
    *       }
    *   }
    * 
    */
}