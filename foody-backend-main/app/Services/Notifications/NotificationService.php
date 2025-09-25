<?php

namespace App\Services\Notifications;

use Google\Auth\Credentials\ServiceAccountCredentials;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;

class NotificationService
{
    protected $client;

    protected $projectId;

    public function __construct()
    {
        $this->projectId = config('services.firebase.project_id');
        //$this->client = new Client([
        //'base_uri' => 'https://fcm.googleapis.com/',
        //]);
    }

    public function sendNotification($token, $title, $body)
    {
        $this->client = new Client(['base_uri' => 'https://fcm.googleapis.com/']);
        $message = [
            'message' => [
                'token' => 'eGwGZWMJQN-oERMpvZpkMH:APA91bHcvo4buW4bDpxjVI4HQealeoCDgppa303en_JqnZ4EcQaCEx3sYqXiu8lsCdryQS8V_M7QKtjH4pM6H73FN2FBYafIN-pZMyIQ-brjwoXbKV2_pcgpvqD2Pwjr5Tgpc78DVFdc',
                'notification' => [
                    'title' => $title,
                    'body' => $body,
                ],
            ],
        ];
        //        $jsonMessage = json_encode($message);
        try {
            $response = $this->client->post("v1/projects/{$this->projectId}/messages:send", [
                RequestOptions::HEADERS => [
                    'Authorization' => 'Bearer '.$this->getAccessToken(),
                    'Content-Type' => 'application/json',
                ],
                RequestOptions::JSON => $message,
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {

            throw new \Exception($e->getMessage());
        }
    }

    private function getAccessToken()
    {
        $credentials = new ServiceAccountCredentials(
            'https://www.googleapis.com/auth/firebase.messaging',
            json_decode(file_get_contents(base_path(config('services.firebase.credentials_file'))), true)
        );

        return $credentials->fetchAuthToken()['access_token'];
    }
}

//namespace App\Services\Notifications;
//
//use Exception;
//
//class NotificationService
//{
//    public static function sendNotification($device_key, $body, $title, $content, $type)
//    {
//        try {
//            $URL = 'https://fcm.googleapis.com/fcm/send';
//
//            $data = [
//                'to' => 'fmqIMLdgT9yow4ahmbZn9t:APA91bFsnHn_MJ-mEqY2WMFkE5TW8FCv2m8ZXBIff-dCXmYWUL1lfmLN8LkgnzkAiOp5gQZ_6iZPEoKPqbnyCA9M2FGe7hQmF2eCKKuMDSUkUpuTOrcB9wsuIBRb1MqU2mW965VKE5wD',
//                'notification' => [
//                    'title' => $title,
//                    'body' => $content,
//                ],
//                'data' => [
//                    'type' => $type,
//                    'body' => $body,
//                ],
//            ];
//
//            $json_data = json_encode($data);
//
//            $crl = curl_init();
//
//            $header = [];
//            $header[] = 'Content-type: application/json';
//            $header[] = 'Authorization: key='.env('SERVER_API_KEY');
//            curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, false);
//            curl_setopt($crl, CURLOPT_URL, $URL);
//            curl_setopt($crl, CURLOPT_HTTPHEADER, $header);
//            curl_setopt($crl, CURLOPT_POST, true);
//            curl_setopt($crl, CURLOPT_POSTFIELDS, $json_data);
//            curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
//            dd(curl_exec($crl));
//
//        } catch (Exception $e) {
//            return 'NOTIFICATION FAILED !';
//        }
//    }
//}
