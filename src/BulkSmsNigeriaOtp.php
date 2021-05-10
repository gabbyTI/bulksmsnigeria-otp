<?php

namespace Gabbyti\BulkSmsNigeriaOtp;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class BulkSmsNigeriaOtp
{
    public static function sendOtpToNumber($OTP, $mobileNumber)
    {
        $API_KEY = config('bulksmsnigeriaotp.api_key');
        $SENDER_ID = config('bulksmsnigeriaotp.sender_id');
        $DND = config('bulksmsnigeriaotp.dnd');
        $RESPONSE_TYPE = 'json';

        $client = new Client([
            'base_uri' => 'https://www.bulksmsnigeria.com'
        ]);

        //Your message to send, Adding URL encoding.
        $message = "Welcome to $SENDER_ID, Your OTP is : $OTP, Do not share with anyone.";


        //Preparing post parameters
        $postData = array(
            'api_token' => $API_KEY,
            'to' => $mobileNumber,
            'from' => $SENDER_ID,
            'body' => $message,
            'dnd' => $DND,
        );

        try {
            $client->request('POST', '/api/v1/sms/create', [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'query' => $postData,
            ]);

            return response()->json([
                'error' => false,
            ]);
        } catch (GuzzleException $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
